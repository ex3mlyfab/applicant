<?php

namespace App\Http\Controllers\Admin\Consult;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClinicalAppointment;
use App\Models\Consult;
use App\Models\User;
use App\Models\VitalSign;

class ConsultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = ClinicalAppointment::all();
        $today = $appointments->where('appointment_due', now()->today());
        $patients = User::all();
        return view('admin.consult.index', compact('appointments', 'today', 'patients'));
    }

    public function consult($id)
    {
        //
        $patient = User::findOrFail($id);


        $appointment = ClinicalAppointment::where('patient_id', $patient->id)->where('appointment_due', now()->today())->first();


        $consults = Consult::all()->whereIn('clinical_appointment_id', $patient->clinicalAppointments->pluck('id'));
        $consult = Consult::firstOrCreate(['clinical_appointment_id' => $appointment->id]);

        $vitals = VitalSign::where('patient_id', $id)->take(10)->get();
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
        // $consults = $consults->toArray();
        return view('admin.consult.create', compact('patient', 'consults', 'appointment', 'consult', 'dataChart'));
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
