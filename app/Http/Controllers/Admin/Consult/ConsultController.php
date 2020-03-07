<?php

namespace App\Http\Controllers\Admin\Consult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClinicalAppointment;
use App\Models\Consult;
use App\Models\User;

class ConsultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = ClinicalAppointment::all();
        $today = $appointments->where('appointment_due', now()->today());
        $patients = User::all();
        return view('admin.consult.index', compact('appointments', 'today', 'patients'));
    }
    public function consult($id)
    {
        //
        $patient = User::findOrFail($id);
        $appointment = ClinicalAppointment::all()->where('status', "completed");
        $appointment = $appointment->where('patient_id', $patient->id)->last();
        $consults = Consult::all()->whereIn('clinical_appointment_id', $patient->clinicalAppointments->pluck('id'));

        // $consults = $consults->toArray();
        return view('admin.consult.create', compact('patient', 'consults', 'appointment'));
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
