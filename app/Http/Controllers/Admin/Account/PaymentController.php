<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\PaymentReceipt;
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
        $payments = Payment::whereDate('created_at', now()->today())->get();
        $weekly = Payment::where('created_at', '>=', now()->today()->subDays(7))->get();
        $weekly = $weekly->groupBy(function (Payment $item) {
            return $item->created_at->format('d/M/Y');
        })->map(function ($row) {
            return $row->sum('amount');
        });
        $weeklychart = [];
        foreach ($weekly as $key => $value) {
            $weeklychart['label'][] = $key;
            $weeklychart['earnings'][] = $value;
        }
        $monthly = Payment::whereYear('created_at', date('Y'))->get();
        $monthly = $monthly->groupBy(function (Payment $item) {
            return $item->created_at->format('M');
        })->map(function ($row) {
            return $row->sum('amount');
        });
        $monthlychart = [];
        foreach ($monthly as $key => $value) {
            $monthlychart['label'][] = $key;
            $monthlychart['earnings'][] = $value;
        }
        $weeklychart['weekly_chart'] = json_encode($weeklychart);
        $monthlychart['monthly_chart'] = json_encode($monthlychart);
        $collectors = $payments->groupBy(function (Payment $item) {
            return $item->admin->full_name;
        })->map(function ($row) {
            return $row->sum('amount');
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
        $service = '';
        if($invoice->invoiceable_type == 'App\Models\Pharmreq'){
            $service = 'pharmacy';
        }
        $coverage = $invoice->user->payment_method;
        switch ($coverage) {
            case 'mdaccount':
                $percentile =$invoice->user->mdAccount->mdAccountCovers->where('name', $service)->first();

                if(($percentile && (($percentile->ends == NULL) ||(now()->between($percentile->starts, $percentile->ends))))){
                    if($percentile->percentage < 100)
                    {
                        $message = "MD covers ".$percentile->percentage."% of charges";
                        $due_payment= $invoice->total_amount - $percentile->percentage/100 * $invoice->total_amount;
                    } else{
                        $message = "MD covers ".$percentile->percentage."% of charges";
                        $due_payment = 0;
                    }
                }
                else{
                    $message = 'out of Md coverage duration';
                    $due_payment = $invoice->total_amount;
                }
                break;
            case 'insured':
                $percentile = $invoice->user->enrollUser->insurancePackage;
                $covered= $percentile->insuranceServices->where('service_type',$service )->first();
                if($covered){
                    if($percentile->percentage < 100){
                        $message = "insurance coverage of ".$percentile->percentage."% of charges";
                        $due_payment= $invoice->total_amount - $percentile->percentage/100 * $invoice->total_amount;
                    }else{
                        $message = "insurance coverage of ".$percentile->percentage."% of charges";
                        $due_payment = 0;
                    }
                }else{
                    $message = "insurance enrollee out of coverage";
                    $due_payment = $invoice->total_amount;

                }
            break;
            default:
            $message = '';
            $due_payment = $invoice->total_amount;
                break;
        }

        return view('admin.payment.pay', compact('invoice', 'due_payment', 'message'));
    }
    public function printInvoice(Invoice $invoice)
    {
        return view('admin.payment.printinvoice', compact('invoice'));
    }
    public function printReceipt(Payment $payment)
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
        dd($request->except('_token'));

        $payment = PaymentReceipt::create([
            'user_id' => $request->user_id,
            'payment_mode_id' => $request->payment_mode,
            'admin_id' => auth()->user()->id

        ]);
        foreach ($request->pay as $key => $value) {
            $data = array(
                'user_id' => $request->user_id,
                'service' => $request->service[$key],
                'invoice_item_id' => $request->invoice_item_id[$key],
                'amount' => $request->amount[$key],
                'admin_id' => Auth::user()->id,
                'invoice_no' => $request->invoice_no,

            );
            Payment::create($data);

            $lab = InvoiceItem::find($data['invoice_item_id']);
            if($lab){
                $lab->update([
                'status' => 'paid'
            ]);
            if ($lab->bill()) {
                $lab->bill()->update([
                    'status' => "item paid",
                ]);
            }
            }
            $invoice = Invoice::where('invoice_no', $request->invoice_no)->first();

            if ($invoice->invoiceItems->contains('status', '')) {
                $invoice->update([
                    'status' => 'partial paid',
                ]);
            } else {
                $invoice->update([
                    'status' => 'paid',
                ]);
            }
        }
        $notification = array(
            'message' => 'Payment made successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('payment.index')->with($notification);
    }
    public function pharmacy(Request $request)
    {
        dd($request->except('_token'));

        $payment = PaymentReceipt::create([
            'user_id' => $request->user_id,
            'payment_mode_id' => $request->payment_mode,
            'admin_id' => auth()->user()->id

        ]);
        foreach ($request->pay as $key => $value) {
            $data = array(
                'user_id' => $request->user_id,
                'service' => $request->service[$key],
                'invoice_item_id' => $request->invoice_item_id[$key],
                'amount' => $request->amount[$key],
                'admin_id' => Auth::user()->id,
                'invoice_no' => $request->invoice_no,

            );
            Payment::create($data);

            $lab = InvoiceItem::find($data['invoice_item_id']);
            if($lab){
                $lab->update([
                'status' => 'paid'
            ]);
            if ($lab->bill()) {
                $lab->bill()->update([
                    'status' => "item paid",
                ]);
            }
            }
            $invoice = Invoice::where('invoice_no', $request->invoice_no)->first();

            if ($invoice->invoiceItems->contains('status', '')) {
                $invoice->update([
                    'status' => 'partial paid',
                ]);
            } else {
                $invoice->update([
                    'status' => 'paid',
                ]);
            }
        }
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
