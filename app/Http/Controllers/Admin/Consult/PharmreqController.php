<?php

namespace App\Http\Controllers\Admin\Consult;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use App\Models\ConsultTest;
use App\Models\Pharmreq;
use App\Models\PharmreqDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PharmreqController extends Controller
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
        dd($request->all);
        $validated = $request->except('_token');
        $pc = Pharmreq::create([
            'clinical_appointment_id' => $request->clinical_appointment_id,
            'seen_by' => 1,
        ]);
        $status = $pc->clinical_appointment_id;
        foreach ($request->medicine as $key => $medicine_id) {
            $data = array(
                'pharmreq_id' => $pc->id,
                'drug_model_id' => $request->drug_model_id[$key],
                'medicine' => $request->medicine[$key],
                'duration' => $request->duration[$key],
                'quantity' => $request->quantity[$key],

            );
            PharmreqDetail::insert($data);
        }

        $consult = Consult::firstOrCreate(['clinical_appointment_id' => $status]);
        $pc->labinfos()->create([
            'consult_id' => $consult->id,
            'type' => 'Drug Prescription',
            'status' => 'waiting',
        ]);

        $notification = array(
            'message' => 'Pharmacy request sent successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
    public function ajaxdrug(Request $request)
    {
        $validated = $request->except('_token');
        $pc = Pharmreq::create([
            'clinical_appointment_id' => $request->clinical_appointment,
            'seen_by' => Auth::user()->id,
        ]);
        $status = $pc->clinical_appointment_id;
        foreach ($request->drug_model_id as $key => $medicine_id) {
            $data = array(
                'pharmreq_id' => $pc->id,
                'drug_model_id' => $request->drug_model_id[$key],
                'dosage' => $request->dosage[$key],
                'duration' => $request->instruction[$key],
                'quantity' => 0,


            );
            PharmreqDetail::insert($data);
        }

        $consult = Consult::firstOrCreate(['clinical_appointment_id' => $status]);
        $created = $pc->labinfos()->create([
            'consult_id' => $consult->id,
            'type' => 'Drug Prescription',
            'status' => 'waiting',
        ]);


        return json_encode($created);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmreq $pharmreq)
    {
        return view('admin.pharmacy.dispense', compact('pharmreq'));
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
