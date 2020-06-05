<?php

namespace App\Http\Controllers\Admin\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\AdmitModel;
use App\Models\Consult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdmitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = AdmitModel::where('status', '!=', 'discharged')->get();
        return view('admin.inpatient.index', compact('all'));
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
        $data = $request->except('_token');
        $data['status'] = 'waiting';
        $data['admin_id'] = Auth::user()->id;
        $id = AdmitModel::create($data);
        $status = $id->clinical_appointment_id;
        $consult = Consult::firstOrCreate(['clinical_appointment_id' => $status]);
        $id->labinfos()->create([
            'consult_id' => $consult->id,
            'type' => 'Sent for Admission',
            'status' => 'waiting',

        ]);
        $notification =
            [
                'message' => 'admission request for patient sent',
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
    public function destroy(AdmitModel $admitpatient)
    {
        $admitpatient->delete();
        $notification = [
            'message' => 'Admition request Cancelled',
            'alert-type' => 'info'
        ];
        return back()->with($notification);
    }
}
