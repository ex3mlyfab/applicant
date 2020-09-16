<?php

namespace App\Http\Controllers\Admin\Consult;

use App\Http\Controllers\Controller;
use App\Models\ClinicalAppointment;
use App\Models\Consult;
use App\Models\User;
use App\Models\VitalSign;
use Illuminate\Http\Request;

class ConsultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // collect all appointment for today for display in the consultation module
        $today = ClinicalAppointment::whereDate('appointment_due', now()->today())->orWhereNotIn('status',['completed'])->get();

        $patients = User::all();
        return view('admin.consult.index', compact('today', 'patients'));
    }

    public function consult($id)
    {
        //
        $patient = User::findOrFail($id);

        // collect all previous appointment of patients
        $appointment = ClinicalAppointment::where('patient_id', $patient->id)->where('appointment_due', now()->today())->first();

        // all previous consultattion details collection
        $consults = Consult::all()->whereIn('clinical_appointment_id', $patient->clinicalAppointments->pluck('id'));
        //start new consultation or maintain new consultation id on event of investigations requests or treatment.



        $consult = Consult::firstOrCreate(['clinical_appointment_id' => $appointment->id]);
        //collect all pc and Pe of patient
        $collection = collect();
        $collection->push($patient->consult)
        dd($collection);
        // collect all vital signs recorded for patient
        $vitals = VitalSign::where('patient_id', $id)->get();
        $vitals = $vitals->groupBy(function (VitalSign $item) {
            return $item->created_at->format('d/m/Y h:i:s A');
        });
        /**
         * this is useful to collect figures for charting in the Application
         */
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
