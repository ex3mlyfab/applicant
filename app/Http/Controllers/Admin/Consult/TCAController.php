<?php

namespace App\Http\Controllers\Admin\Consult;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use App\Models\Tca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TCAController extends Controller
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
        $data = $request->except('_token');
        $data['status'] = 'waiting';
        $data['admin_id'] = Auth::user()->id;
        if ($request->has('call_again')) {
            $call_again = strtotime($request->call_again);
            $newDate = date('Y-m-d', $call_again);
            $data['call_again'] = $newDate;
        }
        $id = Tca::create($data);
        $status = $id->clinical_appointment_id;
        $consult = Consult::firstOrCreate(['clinical_appointment_id' => $status]);
        $id->labinfos()->create([
            'consult_id' => $consult->id,
            'type' => 'Patient to call back on ' . $data['call_again'] . ' ',
            'status' => 'waiting',

        ]);
        $notification =
            [
                'message' => 'Patient to call back on ' . $data['call_again'] . ' ',
                'alert-type' => 'success'
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
