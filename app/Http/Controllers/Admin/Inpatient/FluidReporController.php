<?php

namespace App\Http\Controllers\Admin\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\FluidReport;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FluidReporController extends Controller
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
       if($request->fluid_select == 'others'){
           $fluid = FluidReport::create([
               'inpatient_id' => $request->inpatient_id,
               'fluid' => $request->fluid_name,
               'direction' => $request->direction
           ]);
       }else{
           $fluid = FluidReport::find($request->fluid_select);
       }
       $tip = date('Y-M-d H:i:s', strtotime($request->date_done));
       $fluid->fluidReportDetails()->create([
                'measure'=> $request->measure,
                'done_at' => Carbon::parse($tip),
                'done_by' => auth()->user()->id,
       ]);
         $notification = [
                 'message' => 'Fluid record added successfully',
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
