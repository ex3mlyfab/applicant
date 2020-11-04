<?php

namespace App\Http\Controllers\Admin\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\ClinicalTracker;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClinicalTrackerController extends Controller
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

            ClinicalTracker::create([
                'inpatient_id' => $request->inpatient_id,
                'prepared_by' => $request->prepared_by,
                'clinical_tasks' => $request->clinical_tasks,
                'due_date' => Carbon::parse(strtotime($request->due_date)),
            ]);

             $notification = [
                 'message' => 'clinical Tasks added successfully',
                 'type' =>'success'
             ];
             return back()->with($notification);
    }

    public function recordTask(Request $request)
    {
        $done_by = auth()->user()->id;
        $task = ClinicalTracker::find($request->id);

        $task->update([
            'complete' =>$request->complete,
            'done_by'  => $done_by,
            'done' => 1,

        ]);
        if($request->complete =='ongoing')
        {
            ClinicalTracker::create([
                'inpatient_id' => $task->inpatient->id,
                'prepared_by' => $task->prepared_by,
                'clinical_tasks' => $task->clinical_tasks. '-'.$request->complete,
                'due_date' => Carbon::parse(strtotime($request->due_date)),
            ]);
        }
        $notification = [
            'message' => 'clinical Tasks updated successfully',
            'type' =>'success'
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
    public function destroy($id)
    {
        //
    }
}
