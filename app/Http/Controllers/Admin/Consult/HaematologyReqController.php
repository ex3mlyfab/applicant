<?php

namespace App\Http\Controllers\Admin\Consult;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use App\Models\Haematologyreq;
use Illuminate\Http\Request;

class HaematologyReqController extends Controller
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

        $data = $request->except(['_token', 'clinical_appointment_id']);
        $data['status'] = 'waiting';
        $data['requested_by'] = auth()->user()->id;
        $id = Haematologyreq::create($data);


        $id->testables()->create([
            'encounter_id' => $request->encounter_id,
            'status' => 'waiting',

        ]);
        $notification = array(
            'message' => 'Haematology test requested successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function invoiceAjax($id)
    {
        $invoice = Haematologyreq::where('id', $id)->first();
        return json_encode($invoice);
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
