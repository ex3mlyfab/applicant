<?php

namespace App\Http\Controllers\Admin\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\AdmitModel;
use App\Models\ClinicalAppointment;
use App\Models\Consult;
use App\Models\EncounterTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = AdmitModel::whereIn('status',['waiting'])->get();
        
        return view('admin.inpatient.index', compact('all'));
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
        $data = $request->except(['_token', 'clinical_appointment_id']);
        $data['status'] = 'waiting';
        $data['admin_id'] = Auth::user()->id;
        $id = AdmitModel::create($data);
        $testable = EncounterTest::create([
            'encounter_id' => $request->encounter_id,
            'status' => 'Admit request pending'

        ]);
        $id->testables()->save($testable);
        Consult::firstOrCreate(['clinical_appointment_id' => $request->clinical_appointment_id]);
        ClinicalAppointment::find($request->clinical_appointment_id)->update([
            'status' => 'history_recorded',

        ]);
        $notification =
            [
                'message' => 'admission request for patient sent',
                'alert-type' => 'success'
            ];
        return back()->with($notification);
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
    public function destroy(AdmitModel $admitpatient)
    {
        $admitpatient->delete();
        $notification = [
            'message' => 'Admition request Cancelled',
            'alert-type' => 'info'
        ];
        return back()->with($notification);
    }
}
