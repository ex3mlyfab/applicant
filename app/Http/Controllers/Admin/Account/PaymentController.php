<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\BankTransfer;
use App\Models\Expense;
use App\Models\Inpatient;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\PaymentReceipt;
use App\Models\Pharmreq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = PaymentReceipt::whereDate('created_at', now()->today())->get();
        $weekly = PaymentReceipt::where('created_at', '>=', now()->today()->subDays(7))->get();
        $weekly = $weekly->groupBy(function (PaymentReceipt $item) {
            return $item->created_at->format('d/M/Y');
        })->map(function ($row) {
            return $row->sum('total');
        });
        $weeklychart = [];
        foreach ($weekly as $key => $value) {
            $weeklychart['label'][] = $key;
            $weeklychart['earnings'][] = $value;
        }
        $monthly = PaymentReceipt::whereYear('created_at', date('Y'))->get();
        $monthly = $monthly->groupBy(function (PaymentReceipt $item) {
            return $item->created_at->format('M');
        })->map(function ($row) {
            return $row->sum('total');
        });
        $monthlychart = [];
        foreach ($monthly as $key => $value) {
            $monthlychart['label'][] = $key;
            $monthlychart['earnings'][] = $value;
        }
        $weeklychart['weekly_chart'] = json_encode($weeklychart);
        $monthlychart['monthly_chart'] = json_encode($monthlychart);
        $collectors = $payments->groupBy(function (PaymentReceipt $item) {
            return $item->admin->name;
        })->map(function ($row) {
            return $row->sum('total');
        });




        return view('admin.payment.index', compact('payments', 'weeklychart', 'monthlychart', 'collectors'));
    }
    public function filter()
    {
        return view('admin.payment.filterpayment');
    }
    public function filtersearch(Request $request)
    {
        if ($request->has('date')) {
            $dob = strtotime($request->date);
            $newDate = date('Y-m-d', $dob);
            $results = Payment::whereDate('created_at', $newDate)->get();
        } else if ($request->has('year')) {
            $results = Payment::whereYear('created_at', $request->year)->get();
        } else {
            $start = strtotime($request->daterange1);
            $newDate = date('Y-m-d', $start);
            $end = strtotime($request->daterange2);
            $newDate2 = date('Y-m-d', $end);
            $results = Payment::whereBetween('created_at', [$newDate, $newDate2])->get();
        }
        return view('admin.payment.filterpayment', compact('results'));
    }

    //retreieve monthly revenue and expenditure
    public function balance()
    {
        $payments = Payment::whereMonth('created_at', date('m'))->get();
        $expenditure = Expense::whereMonth('created_at', date('m'))->get();

        return view('admin.payment.pl', compact('payments', 'expenditure'));
    }
    public function settleInvoice(Invoice $invoice)
    {

        return view('admin.payment.pay', compact('invoice'));
    }
    public function printInvoice(Invoice $invoice)
    {
        return view('admin.payment.printinvoice', compact('invoice'));
    }
    public function printReceipt(PaymentReceipt $payment)
    {
        return view('admin.payment.printreceipt', compact('payment'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function pay(Request $request)
    {
        //  dd($request->except('_token'));
        $invoice = Invoice::findOrFail($request->invoice_id);
        $pay = explode(',', $request->pay_control);
        $pay= collect($pay);

        $totalpaid = $request->totalpaid;


        if($request->part_payment){
            if($request->payment_mode == 5 || $request->part_amount <= 0){
                return back()->with([
                    'message' => 'Cannot Pay Later with Part-Payment',
                    'type' => 'danger'
                ]);
            }
            $remaining = $invoice->amount - $totalpaid;
            if ($remaining > 0){
                $balance = $invoice->invoiceItems->filter(function($value){
                    return $value->item_description == 'Balance';
                });
                if($balance->count()){
                    $balance->first()->update([
                        'amount' => (double) $remaining,
                        'status' => 'NYP'
                    ]);
                }else{
                    $invoice->invoiceItems()->create([
                        'item_description' =>'Balance',
                        'amount' =>  $remaining,
                        'status' => 'NYP'
                    ]);
                }
                $invoice->invoiceItems()->create([
                    'item_description' =>'Part-payment paid on '. now()->format('d/M/Y'),
                    'amount' =>  -$totalpaid,
                    'status' => 'paid'
                ]);

              $invoice->update([
                  'amount' => $remaining
              ]);
            }


        }
        //check if inpatient has been discharged from the hospital to ensure that invoice remains open
        if($invoice->invoiceable_type == 'App\Models\Inpatient'){
            //check if patient is discharged
            $inpatientDetails = Inpatient::findOrFail($request->invoice_type_id);

            if($inpatientDetails->status != 'discharged'){
                //check if there's balance column
                $balance = $invoice->invoiceItems->filter(function($value){
                    return $value->item_description == 'Balance';
                });
                //and if there's none create one.
                if(!($balance->count())){
                    $invoice->invoiceItems()->create([
                        'item_description' =>'Balance',
                        'amount' =>  $remaining,
                        'status' => 'NYP'
                    ]);
                }

            }


        }
        if($request->payment_mode != 5)
        {
        $payment = PaymentReceipt::create([
            'user_id' => $request->user_id,
            'payment_mode_id' => $request->payment_mode,
            'admin_id' => auth()->user()->id,
            'total' => $totalpaid,
            'receipt_no' => generate_invoice_no()

        ]);
        foreach ($invoice->invoiceItems as $key => $value) {
            if ($pay->contains($value->id)) {
                $usekey = array_keys($request->invoice_item_id, $value->id);
                $data = array(
                'service' => $request->service[$usekey[0]],
                'payment_receipt_id' => $payment->id,
                'amount' => $request->amount[$usekey[0]],
                'status' => 'paid'
            );
            Payment::create($data);

                $value->update([
                'status' => 'paid'
            ]);
            //highlight paid for section and update details to indicate payment
            }
        }

        switch ($request->payment_mode) {
                case 2:
                    BankTransfer::create([
                        'bank_id' => $request->transfer_id,
                        'user_id' => $request->user_id,
                        'amount_transfered' => $totalpaid,
                        'status' => 'Transfer'
                    ]);
                    break;
                case 3:
                    BankTransfer::create([
                        'bank_id' => $request->transfer_id,
                        'user_id' => $request->user_id,
                        'amount_transfered' => $totalpaid,
                        'status' => 'POS'
                    ]);

                    break;
                case 7:
                    BankTransfer::create([
                        'bank_id' => $request->transfer_id,
                        'user_id' => $request->user_id,
                        'amount_transfered' => $request->bank_amount,
                        'status' => 'Transfer'
                    ]);
                    break;

                case 8:
                    BankTransfer::create([
                        'bank_id' => $request->transfer_id,
                        'user_id' => $request->user_id,
                        'amount_transfered' => $request->bank_amount,
                        'status' => 'POS'
                    ]);
                    break;
            }


            // $pharm->payments()->save($payment);
            if ($invoice->invoiceItems->contains('status', 'NYP')) {
                $invoice->update([
                    'p_status' => 'partial paid',
                    'amount' => $invoice->invoiceItems->reduce(function($carry,$item){
                        if($item->status=='NYP'){
                            return $carry + $item->amount;
                        }
                    })
                ]);
            } else if($request->part_payment && $invoice->amount > $totalpaid){
                $invoice->update([
                    'p_status' => 'partial paid',
                ]);
            } else {
                $invoice->update([
                    'p_status' => 'paid',
                ]);
            }
        }else{

            $invoice->update([
                'status' => 'credit',
            ]);
        }
        $notification = array(
            'message' => 'Payment made successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('payment.index')->with($notification);


    }
    public function pharmacy(Request $request)
    {
        // dd($request->except('_token'));
        $invoice = Invoice::findOrFail($request->invoice_id);
        $pharm = Pharmreq::findOrFail($request->invoice_type_id);
        // dd($pharm->pharmreqDetails);
        $drugs = $pharm->pharmreqDetails;
        $totalpaid = $request->totalpaid;

        $pay = explode(',', $request->pay_control);
        $pay= collect($pay);
        // // dd($pay);

        // foreach ($drugs as $key => $value) {
        //     // array_search($drugs_id[$key], $pay);

        //  if($pay->contains($value->invoice_item_id)){
        //      $usekey = array_keys($request->invoice_item_id, $value->invoice_item_id );
        //     //  dd($usekey[0]);
        //      array_push($tests,$usekey[0]);
        //  }
        // }
        // dd($tests);
        //wonderful logic to know a slected row from the options
        if($request->part_payment){
            if($request->payment_mode == 5 || $request->part_amount <= 0){
                return back()->with([
                    'message' => 'Cannot Pay Later with Part-Payment',
                    'type' => 'danger'
                ]);
            }
            $remaining = $invoice->amount - $totalpaid;
            if ($remaining > 0){
                $balance = $invoice->invoiceItems->filter(function($value){
                    return $value->item_description == 'Balance';
                });
                if($balance->count()){
                    $balance->first()->update([
                        'amount' => (double) $remaining,
                        'status' => 'NYP'
                    ]);
                }else{
                    $invoice->invoiceItems()->create([
                        'item_description' =>'Balance',
                        'amount' =>  $remaining,
                        'status' => 'NYP'
                    ]);
                }
                $invoice->invoiceItems()->create([
                    'item_description' =>'Part-payment paid on '. now()->format('d/M/Y'),
                    'amount' =>  -$totalpaid,
                    'status' => 'paid'
                ]);

              $invoice->update([
                  'amount' => $remaining
              ]);
            }


        }
        if($request->payment_mode != 5)
        {
        $payment = PaymentReceipt::create([
            'user_id' => $request->user_id,
            'payment_mode_id' => $request->payment_mode,
            'admin_id' => auth()->user()->id,
            'total' => $totalpaid,
            'receipt_no' => generate_invoice_no()

        ]);
        foreach ($drugs as $key => $value) {
            if ($pay->contains($value->invoice_item_id)) {
                $usekey = array_keys($request->invoice_item_id, $value->invoice_item_id);
                $data = array(
                'service' => $request->service[$usekey[0]],
                'payment_receipt_id' => $payment->id,
                'amount' => $request->amount[$usekey[0]],
                'status' => 'paid'
            );
            Payment::create($data);
                $value->invoiceItem()->update(['status'=> 'paid']);
                //update invoice item
                $value->update([
                'status' => 'paid'
            ]);
            //highlight paid for section and update details to indicate payment
            }
        }

        if(in_array('Balance', $request->service)){

            $usekey = array_keys($request->service, 'Balance');
             $iteminvoice = InvoiceItem::findOrFail($request->invoice_item_id[$usekey[0]]);
                $data = array(
                'service' => $request->service[$usekey[0]]. ' Payment',
                'payment_receipt_id' => $payment->id,
                'amount' => $request->amount[$usekey[0]],
                'status' => 'paid'
            );
            Payment::create($data);
            $iteminvoice->update([
                'status' => 'paid'
            ]);
        }
        switch ($request->payment_mode) {
                case 2:
                    BankTransfer::create([
                        'bank_id' => $request->transfer_id,
                        'user_id' => $request->user_id,
                        'amount_transfered' => $totalpaid,
                        'status' => 'Transfer'
                    ]);
                    break;
                case 3:
                    BankTransfer::create([
                        'bank_id' => $request->transfer_id,
                        'user_id' => $request->user_id,
                        'amount_transfered' => $totalpaid,
                        'status' => 'POS'
                    ]);

                    break;
                case 7:
                    BankTransfer::create([
                        'bank_id' => $request->transfer_id,
                        'user_id' => $request->user_id,
                        'amount_transfered' => $request->bank_amount,
                        'status' => 'Transfer'
                    ]);
                    break;

                case 8:
                    BankTransfer::create([
                        'bank_id' => $request->transfer_id,
                        'user_id' => $request->user_id,
                        'amount_transfered' => $request->bank_amount,
                        'status' => 'POS'
                    ]);
                    break;
            }

            $pharm->update([
                'status' => 'item paid'
            ]);
            $pharm->payments()->save($payment);
            if ($invoice->invoiceItems->contains('status', 'NYP')) {
                $invoice->update([
                    'p_status' => 'partial paid',
                    'amount' => $invoice->invoiceItems->reduce(function($carry,$item){
                        if($item->status=='NYP'){
                            return $carry + $item->amount;
                        }
                    })
                ]);
            } else if($request->part_payment && $invoice->amount > $totalpaid){
                $invoice->update([
                    'p_status' => 'partial paid',
                ]);
            } else {
                $invoice->update([
                    'p_status' => 'paid',
                ]);
            }
        }else{

            $pharm->update([
                'status' => 'item paid'
            ]);
            $invoice->update([
                'status' => 'credit',
            ]);
        }
        $pharm->testable()->update([
            'status' => 'item paid'
        ]);
        $notification = array(
            'message' => 'Payment made successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('payment.index')->with($notification);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
