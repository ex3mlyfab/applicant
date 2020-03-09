<?php

namespace App\Http\Controllers\Admin\Front;

use App\Http\Controllers\Controller;
use App\Models\ClinicalAppointment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VitalSign;

class VitalSignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = ClinicalAppointment::where('appointment_due', Carbon::today())->get();

        return view('admin.nursing.index', compact('today'));
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

    public function takeVitals($id)
    {
        $patient = User::findOrFail($id);
        return view('admin.nursing.create', compact('patient'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'weight' => 'required',
            'height' => 'required',
            'rr' => 'required',
            'pr' => 'required',
            'temp' => 'required',
            'systolic' => 'required',
            'diastolic' => 'required',
            'patient_id' => 'required',
            'bmi' => 'nullable'
        ]);

        $validated['done_by'] = 1;

        $update = ClinicalAppointment::where('patient_id', $request->patient_id)->where('appointment_due', Carbon::today())->where('status', 'waiting')->first();
        $update->status = 'vitals sign taken';
        $update->timestamps = false;
        $update->save();

        VitalSign::create($validated);
        $notification = array(
            'message' => 'vital sign recorded successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('nursing.index')->with($notification);
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
