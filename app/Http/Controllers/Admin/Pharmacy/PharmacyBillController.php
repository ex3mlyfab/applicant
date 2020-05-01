<?php

namespace App\Http\Controllers\Admin\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PharmacyBill;
use App\Models\PharmacyBillDetail;
use App\Models\Pharmreq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacyBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function prepare(Request $request)
    {
        $haempay = Pharmreq::findOrFail($request->pharmreq_id);
        $data = $request->except('_token');
        $invoice = Invoice::where('user_id', $haempay->clinicalAppointment->user->id)->where('created_at', now()->today())->first();
        if (!(isset($invoice))) {
            $invoice =  Invoice::create([
                'user_id' => $haempay->clinicalAppointment->user->id,
                'invoice_no' => generate_invoice_no(),

            ]);
        }


        $pharmbill = PharmacyBill::create([
            'user_id' => $haempay->clinicalAppointment->user->id,
            'consultant_id' => $haempay->seen_by,
            'pharmacist_id' => Auth::user()->id,
            'amount' => $request->amount,
            'discount' => 0,
            'vat' => 0,
            'gross_amount' => $request->amount,
            'status' => 'NYP',
            'payment_method' => 'cash',

        ]);
        foreach ($request->drugmodel as $key => $value) {
            PharmacyBillDetail::create([
                'pharmacybill_id' => $pharmbill->id,
                'drug_model_id' => $request->drugmodel[$key],
                'batch_no' => $request->batch_no[$key],
                'quantity' => $request->quantity[$key],
                'unit_cost' => $request->unit_cost[$key],
                'amount' => $request->drug_cost[$key],
            ]);
        }
        $haempay->update([
            'status' => 'invoice generated',
        ]);
        $notification = [
            'message' => 'Invoice Generated Successfully',
            'alert-type' => 'success'
        ];
        return json_encode($notification);
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
        $data = $request->except('_token');
        $invoice = Invoice::where('user_id', $request->user_id)->where('created_at', now()->today())->first();
        if (!(isset($invoice))) {
            $invoice =  Invoice::create([
                'user_id' => $request->user_id,
                'invoice_no' => generate_invoice_no(),

            ]);
        }
        $haempay = Pharmreq::findOrFail($request->haem_id);
        $haempay->invoices()->create([
            'invoice_id' => $invoice->id,
            'item_description' => $request->item_description,
            'amount' => $request->amount,
            'charge_id' => $request->charge_id,
        ]);
        $pharmbill = PharmacyBill::create([
            'user_id' => $request->user_id,
            'consultant_id' => $haempay->seen_by,
            'pharmacist_id' => Auth::user()->id,
            'amount' => $request->amount,
            'discount' => $request->discount,
            'vat' => $request->vat,
            'gross_amount' => $request->amount,
            'status' => 'NYP',
            'payment_method' => 'cash',

        ]);
        foreach ($request->drug_model_id as $key => $value) {
            PharmacyBillDetail::create([
                'pharmacybill_id' => $pharmbill->id,
                'drug_model_id' => $request->drug_model_id[$key],
                'batch_no' => $request->batch_no[$key],
                'quantity' => $request->quantity[$key],
                'unit_cost' => $request->unit_cost[$key],
                'amount' => $request->amount[$key],
            ]);
        }
        $haempay->update([
            'status' => 'invoice generated',
        ]);
        $notification = [
            'message' => 'Invoice Generated Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('pharmacy.index')->with($notification);
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
