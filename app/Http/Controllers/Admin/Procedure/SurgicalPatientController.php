<?php

namespace App\Http\Controllers\Admin\Procedure;

use App\Http\Controllers\Controller;
use App\Models\OperatingRoom;
use App\Models\ProcedureRequest;
use Illuminate\Http\Request;

class SurgicalPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procedures = ProcedureRequest::where('status', Null)->orWhere('status', 'paid')->get();
        return view('admin.procedure.index', compact('procedures'));
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
    public function confirmPayment(Request $request)
    {
        $procedure = ProcedureRequest::find($request->procedure_request_id);
        $procedure->update([
            'status' => 'paid'
        ]);
        $notification =[
            'message' => 'payment confirmed successfully',
            'type' => 'success'
        ];
        return back()->with($notification);
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
        $data = $request->except('_token', 'procedure_request');
        $data['performed_by'] = auth()->user()->id;
        $report = OperatingRoom::create($data);
        $procedure = ProcedureRequest::find($request->procedure_request);
        $procedure->update([
            'status' => 'done'
        ]);
        $notification =[
            'message' => 'detailed recorded successfully',
            'type' => 'success'
        ];
        return view('admin.procedure.preoperative', compact('report'))->with($notification);
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
