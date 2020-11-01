<?php

namespace App\Http\Controllers\Admin\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\DrugModel;
use App\Models\Invoice;
use App\Models\PharmacyBill;
use App\Models\PharmacyBillDetail;
use App\Models\Pharmreq;
use App\Models\PharmreqDetail;
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

        $total_items = DrugModel::all()->count();
        $dispensed = PharmacyBill::whereDate('created_at', now()->today())->get();
        $awaiting = Pharmreq::where('status', '!=', 'dispensed')->get();
        $topselling = 0;
        return view('admin.pharmacy.dashboard', compact('total_items', 'dispensed', 'awaiting', 'topselling'));
    }
    public function billdrug()
    {
        $results = PharmacyBill::whereDate('created_at', now()->today())->get();

        return view('admin.pharmacy.dispensed', compact('results'));
    }
    public function dispensedrug(Pharmreq $pharmreq)
    {
        $paidfor = [];
        foreach ($pharmreq->pharmreqDetails as $key => $value) {
            if($pharmreq->encounter->encounterable_type == 'App\Models\Inpatient'|| ($value->status != NULL) ){
                    array_unshift($paidfor, $value);
            }
        }

        return view('admin.pharmacy.dispensedrug', compact('pharmreq', 'paidfor'));
    }
    public function confirmdispense(Request $request)
    {
        // dd($request->except('_token'));

        $pharmreq = Pharmreq::find($request->pharmreq_id);
        $dispense = PharmacyBill::create([
            'user_id' => $pharmreq->encounter->user->id,
            'consultant_id' => $pharmreq->seen_by,
            'pharmacist_id' => auth()->user()->id,
            'pharmreq_id' => $pharmreq->id,
        ]);
        foreach ($request->pharmreq_detail_id as $key => $value) {
            $drug = PharmreqDetail::find($request->pharmreq_detail_id[$key]);
            $data = array(
                'pharmacy_bill_id' => $dispense->id,
                'drug_model_id' => $request->drug_model_id[$key],
                'quantity' => $request->dispensed_quantity[$key],
                'unit_cost' => $drug->drugModel->price,
                'amount' => $drug->drugModel->price * $request->dispensed_quantity[$key],
                'dosage' =>$drug->dosage,
                'duration' => $drug->duration
            );
            PharmacyBillDetail::create($data);

            $remaining = $drug->drugModel->drugBatchDetails()->firstWhere('available_quantity', '>', (int) $request->quantity[$key]);

            $remaining->decrement('available_quantity', (float) $request->dispensed_quantity[$key]);
            $drug->update(['dispensed'=> true]);
        }

        $pharmreq->update([
            'status' => 'dispensed'
        ]);

        $pharmreq->testable->update([
            'status' => 'Drug dispensed',
        ]);

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

    public function prepare()
    {
       $prescriptions = Pharmreq::where('status', '!=', 'dispensed')->orWhere('status', NULL)->get();

        return view('admin.pharmacy.index', compact('prescriptions'));
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
