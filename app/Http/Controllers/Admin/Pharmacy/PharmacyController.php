<?php

namespace App\Http\Controllers\Admin\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\DrugModel;
use App\Models\Invoice;
use App\Models\PharmacyBill;
use App\Models\PharmacyBillDetail;
use App\Models\Pharmreq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prescriptions = Pharmreq::where('status', '!=', 'dispensed')->orWhere('status', NULL)->get();
        // dd($prescriptions);
        return view('admin.pharmacy.index', compact('prescriptions'));
    }
    public function billdrug(Request $request)
    {
        $pharmreq = Pharmreq::where('id', $request->item_id)->first();

        return view('admin.pharmacy.costdrug', compact('pharmreq'));
    }
    public function dispensedrug(Pharmreq $pharmreq)
    {

        return view('admin.pharmacy.dispensedrug', compact('pharmreq'));
    }
    public function confirmdispense(Request $request)
    {

        $pharmreq = Pharmreq::find($request->pharmreq_id);
        $pharmreq->update([
            'status' => 'dispensed'
        ]);
        $pharmreq->pharmacyBill()->update([
            'status' => 'Drug dispensed',
        ]);
        $pharmreq->labinfos()->update([
            'status' => 'Drug dispensed',
        ]);
        foreach ($request->drug_model_id as $key => $value) {
            $drug = DrugModel::find($request->drug_model_id[$key]);

            $remaining = $drug->drugBatchDetails()->firstWhere('available_quantity', '>', (int) $request->quantity[$key]);

            $remaining->decrement('available_quantity', (int) $request->quantity[$key]);
        }
        $notification = [
            'message' => 'Drug dispensed successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('pharmacy.index')->with($notification);
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

    public function prepare(Request $request)
    {
        $haempay = Pharmreq::findOrFail($request->pharmid);
        $data = $request->except('_token');
        $invoice = Invoice::where('user_id', $haempay->clinicalAppointment->user->id)->where('created_at', now()->today())->first();
        if (!(isset($invoice))) {
            $invoice =  Invoice::create([
                'user_id' => $haempay->clinicalAppointment->user->id,
                'invoice_no' => generate_invoice_no(),

            ]);
        }


        $pharmbill = PharmacyBill::create([
            'pharmreq_id' => $haempay->id,
            'consultant_id' => $haempay->seen_by,
            'pharmacist_id' => Auth::user()->id,
            'amount' => $request->amount,
            'discount' => 0,
            'vat' => 0,
            'gross_amount' => $request->amount,
            'status' => 'NYP',
            'invoice_id' => $invoice->id,

        ]);
        foreach ($request->drug_id as $key => $value) {
            if ($request->choosen[$key]) {
                PharmacyBillDetail::create([
                    'pharmacybill_id' => $pharmbill->id,
                    'drug_model_id' => $request->drug_id[$key],
                    'batch_no' => $request->batch_no[$key],
                    'quantity' => $request->quantity[$key],
                    'unit_cost' => $request->unit_cost[$key],
                    'amount' => $request->drug_amount[$key],
                ]);
                $haempay->invoices()->create([
                    'invoice_id' => $invoice->id,
                    'item_description' => $request->drug_name[$key],
                    'amount' => $request->drug_amount[$key],

                ]);
            }
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
