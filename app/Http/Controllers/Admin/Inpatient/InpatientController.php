<?php

namespace App\Http\Controllers\Admin\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\AdmitModel;
use App\Models\Inpatient;
use App\Models\Retainership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InpatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $onadmission = Inpatient::where('status', 'admission active')->get();
        return view('Admin.inpatient.admission', compact('onadmission'));
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


        $doa = strtotime($request->date_of_admission);
        $newDate = date('Y-m-d', $doa);
        $toa = strtotime($request->time_of_admission);
        $newtime = date('H:i', $toa);
        $adminreq = AdmitModel::findOrFail($request->admin_req_id);
        $adminreq->update([
            'status' => 'admitted'
        ]);

        Inpatient::create([
            'user_id' => $request->patient_id,
            'time_of_admission' => $newtime,
            'date_of_admission' => $newDate,
            'bed_id' => $request->bed_id,
            'credit_limit' => $request->credit_limit,
            'status' => 'admission active',
        ]);
        $balance = Retainership::where('user_id', $request->patient_id)->get();

        $oldbalance = ($balance->count() > 0) ? $balance->last()->balance : 0;
        Retainership::create([
            'user_id' => $request->patient_id,
            'comment' => 'Deposit collected by ' . Auth::user()->name,
            'debit'  => $request->deposit,
            'balance' => $oldbalance + $request->deposit,
        ]);
        $notification = [
            'message' => 'admission processed succesfully',
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
