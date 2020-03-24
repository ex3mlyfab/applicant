<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all()->sortByDesc('created_at');
        $unpaid = Invoice::where('p_status', NULL)->get();

        return view('admin.payment.index', compact('unpaid', 'payments'));
    }
    public function settleInvoice(Invoice $invoice)
    {
        return view('admin.payment.pay', compact('invoice'));
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


        foreach ($request->pay as $key => $value) {
            $data = array(
                'user_id' => $request->user_id,
                'service' => $request->service[$key],
                'invoice_item_id' => $request->invoice_item_id[$key],
                'amount' => $request->amount[$key],
                'admin_id' => 1,
                'invoice_no' => $request->invoice_no,
                'payment_mode_id' => 1,
            );
            Payment::create($data);

            $lab = InvoiceItem::findOrFail($data['invoice_item_id']);
            $lab->update([
                'status' => 'paid'
            ]);
            $lab->bill()->update([
                'status' => "item paid",
            ]);
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
