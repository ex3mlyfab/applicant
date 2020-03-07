<?php

namespace App\Http\Controllers\Admin\Consult;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use App\Models\PresentingComplaint;
use Illuminate\Http\Request;



class PresentingComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $validated = $request->except('_token');
        $pc = PresentingComplaint::create($validated);
        $status = $pc->clinical_appointment_id;
        $consult = Consult::firstOrCreate(['clinical_appointment_id' => $status]);
        $consult->update([
            'presenting_complaint_id' => $pc->id
        ]);
        $consult->clinicalAppointment()->update([
            'status' => 'completed'
        ]);
        $notification = array(
            'message' => 'Presenting Complaints recorded successfully!',
            'alert-type' => 'success'
        );
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
    public function destroy($id)
    {
        //
    }
}
