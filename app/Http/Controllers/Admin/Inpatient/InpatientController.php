<?php

namespace App\Http\Controllers\Admin\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\AdmitModel;
use App\Models\Consult;
use App\Models\Inpatient;
use App\Models\Retainership;
use App\Models\VitalSign;
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
        // collect all list presently on admission
        $onadmission = Inpatient::where('status', 'admission active')->get();
        return view('Admin.inpatient.admission', compact('onadmission'));
    }

    /**
     * Show the form for making ward round by doctors.
     *
     * @return \Illuminate\Http\Response
     */
    public function wardRound(Inpatient $inpatient)
    {
        // collect all previous consultation records
        $consults = Consult::whereIn('clinical_appointment_id', $inpatient->user->clinicalAppointments->pluck('id'));
        // patient details
        $patient = $inpatient->user();
        // collect all vital signs

        $vitals = VitalSign::where('patient_id', $inpatient->user->id)->get();
        $vitals = $vitals->groupBy(function (VitalSign $item) {
            return $item->created_at->format('d/m/Y h:i:s A');
        });

        $dataChart = [];
        foreach ($vitals as $item => $values) {
            $dataChart['label'][] = $item;
            foreach ($values as $value) {
                $dataChart['systolic'][] = (float) $value->systolic;
                $dataChart['diastolic'][] = (int) $value->diastolic;
                $dataChart['height'][] = (float) $value->height;
                $dataChart['weight'][] = (float) $value->weight;
                $dataChart['rr'][] = (int) $value->rr;
                $dataChart['pr'][] = (int) $value->pr;
                $dataChart['temp'][] = (float) $value->temp;
                $dataChart['bmi'][] = (float) $value->bmi;
            }
        }
        $dataChart['chart_data'] = json_encode($dataChart);
        return view('admin.inpatient.create', compact('dataChart', 'vitals', 'consults', 'inpatient', 'patient'));
    }
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
            'condition' => $adminreq->clinical_information,
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
