<?php

namespace App\Http\Controllers\Admin\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\NursingReport;
use Illuminate\Http\Request;

class NursingReportController extends Controller
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
        $data = $request->validate([
            'inpatient_id' => 'required',
            'duty' => 'required',
            'report' => 'required',
            'written_by' => 'required'
        ]);

        NursingReport::create($data);

        $notification = [
            'message' => 'Nursing Report created',
            'type' => 'success'
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
    public function update(Request $request, NursingReport $nursingReport)
    {
        //
        $nursingReport->update([
            'duty' => $request->duty,
            'report' => $request->report
        ]);
        $notification = [
            'message' => 'Nursing Report updated successfully',
            'type' => 'success'
        ];
        return back()->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NursingReport $nursingReport)
    {
        $nursingReport->delete();
         $notification = [
            'message' => 'Nursing Report deleted',
            'type' => 'danger'
        ];
        return back()->with($notification);
    }
}
