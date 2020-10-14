<?php

namespace App\Http\Controllers\Admin\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\TreatmentSheet;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TreatmentSheetController extends Controller
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
        //dd($request->except('_token'));

    foreach ($request->treatment as $key => $value) {
       TreatmentSheet::create([
           'inpatient_id' => $request->inpatient_id,
           'admin_id' => $request->admin_id,
           'treatment' => $request->treatment[$key]
       ]);
    }
        $notification = [
            'message' => 'Treatment sheet created successfully',
            'type' =>'success'
        ];
        return back()->with($notification);
    }
    public function changeStatus(Request $request)
    {
        $status= TreatmentSheet::where('id', $request->pid)->first();

        $change = ($status->continue) ? false : true;
        $status->update([
            'continue' => $change
        ]);
        return json_encode($status);
    }
    public function recordTreatment(Request $request)
    {
        // dd($request->except('_token'));
        $trial =$request->date_of_admission;
        $tip = strtotime($trial);
        $tip = date('Y-M-d H:i:s', $tip);
        $tip = Carbon::parse($tip);
        $treatment = TreatmentSheet::findOrFail($request->id);
        $treatment->treatmentCharts()->create([
            'done' =>true,
            'done_at' => $tip,
            'admin_id' => auth()->user()->id,
        ]);
        $notification =[
            'message' => 'mark as done',
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
