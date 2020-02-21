<?php

namespace App\Http\Controllers\Admin\Front;

use App\Http\Controllers\Controller;
use App\Models\ClinicalAppointment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Charge;
use App\Models\Payment;
use Auth;
use Carbon\Carbon;

class ClinicalAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = ClinicalAppointment::all();
        $today = $appointments->where('appointment_due', Carbon::today());
        $patients = User::all();
        $charge = Charge::where('name', 'appointment')->first();

        return view('admin.appointment.index', compact('appointments', 'patients', 'charge', 'today'));
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

        $validated = $request->validate([
            'patient_id' => 'required',
            'to_see' => 'nullable',
            'appointment_due' => 'required',
        ]);
        $admin_id = 1;


        if ($request->has('appointment_due')) {
            $dob = strtotime($request->appointment_due);
            $newDate = date('Y-m-d', $dob);
            $validated['appointment_due'] = $newDate;
        }

        $validated['status'] = "waiting";
        $payment_id = Payment::create([
            'user_id' => $request->patient_id,
            'admin_id' => $admin_id,
            'payment_mode_id' => 1,
            'service' => "Appointment",
            'amount' => $request->charges,
            'invoice_no' => "2",
        ]);

        $validated['payment_id'] = $payment_id->id;
        if (isset($payment_id)) {
            $validated['payment_status'] = "paid";
        }
        ClinicalAppointment::create($validated);

        $notification = array(
            'message' => 'Appointment created successfully!',
            'alert-type' => 'success'
        );

        return redirect('admin/clinicalappointment')->with($notification);
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
