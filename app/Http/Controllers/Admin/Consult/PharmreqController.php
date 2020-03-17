<?php

namespace App\Http\Controllers\Admin\Consult;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use App\Models\ConsultTest;
use App\Models\Pharmreq;
use App\Models\PharmreqDetail;
use Illuminate\Http\Request;

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
        $validated = $request->except('_token');
        $pc = Pharmreq::create([
            'clinical_appointment_id' => $request->clinical_appointment_id,
            'seen_by' => 1,
        ]);
        $status = $pc->clinical_appointment_id;
        foreach ($request->medicine as $key => $medicine_id) {
            $data = array(
                'pharmreq_id' => $pc->id,
                'medicine' => $request->medicine[$key],
                'duration' => $request->duration[$key],
                'quantity' => $request->quantity[$key],

            );
            PharmreqDetail::insert($data);
        }

        $consult = Consult::firstOrCreate(['clinical_appointment_id' => $status]);
        $consult->consultTests()->create([
            'test_id' => $pc->id,
            'type' => 'Drug Prescription',
            'status' => 'waiting',
        ]);

        $notification = array(
            'message' => 'Pharmacy request sent successfully!',
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
