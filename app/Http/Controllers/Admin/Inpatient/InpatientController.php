<?php

namespace App\Http\Controllers\Admin\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\AdmitModel;
use App\Models\Bed;
use App\Models\Consult;
use App\Models\Encounter;
use App\Models\Inpatient;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Retainership;
use App\Models\VitalSign;
use Carbon\Carbon;
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
    public function dashboard()
    {
        $inpatients = Inpatient::all();
        $beds = Bed::all();
        $admit_request = AdmitModel::where('status', '!=', 'admitted')->get();
        return view('admin.inpatient.dashboard', compact('inpatients', 'beds', 'admit_request'));
    }
    /**
     * Show the form for making ward round by doctors.
     *
     * @return \Illuminate\Http\Response
     */
    public function wardRound(Inpatient $inpatient)
    {

        $vitals = VitalSign::where('patient_id', $inpatient->user->id)->get();
        $vitals = $vitals->groupBy(function (VitalSign $item) {
            return $item->created_at->format('d/m/Y h:i:s A');
        });
        if( !($inpatient->encounter)){

            $encounter= Encounter::create([
                'user_id' => $inpatient->user->id,
            ]);
            $inpatient->encounter()->save($encounter);


       }else{
           $encounter = $inpatient->encounter;
       }
        $dataChart = [];
        foreach ($vitals as $item => $values) {
            $dataChart['label'][] = $item;
            foreach ($values as $value) {
                $dataChart['systolic'][] = (float) $value->systolic;
                $dataChart['diastolic'][] = (int) $value->diastolic;
                $dataChart['rr'][] = (int) $value->rr;
                $dataChart['pr'][] = (int) $value->pr;
                $dataChart['temp'][] = (float) $value->temp;
                $dataChart['spo2'][] = (float) $value->spo2;
            }
        }
        $dataChart['chart_data'] = json_encode($dataChart);
        return view('admin.inpatient.create', compact('dataChart', 'vitals', 'inpatient','encounter'));
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

        // dd($request->except('_token'));
        // dd(Carbon::parse($request->date_of_admission));

        $pint = strtotime($request->date_of_admission);
        // dd($pint);
        $tip = date('Y-M-d H:i:s', $pint);
        $tip = Carbon::parse($tip);

        $adminreq = AdmitModel::findOrFail($request->admin_req_id);
        $adminreq->update([
            'status' => 'admitted'
        ]);
        $adminreq->testables()->update([
            'status' => 'admitted'
        ]);
        $inpatient= Inpatient::create([
            'user_id' => $request->patient_id,

            'date_of_admission' =>$tip ,
            'bed_id' => $request->bed_id,
            'bill' => $request->bill,
            'status' => 'admission active',
            'condition' => $adminreq->clinical_information,
        ]);
        $inpatient->bed()->update([
            'status' => 'occupied',
        ]);
        $encounter = Encounter::create([
            'user_id' => $adminreq->encounter->user->id,
        ]);
        $inpatient->encounter()->save($encounter);
        $invoice = Invoice::create([
            'user_id' =>$encounter->user->id,
            'invoice_no' => generate_invoice_no(),
            'amount' => $request->bill,
            'p_status' => 'NYP',
            'status' => 'pharmacy',
            'admin_id' => auth()->user()->id,
        ]);

            $data = array(
            'invoice_id' => $invoice->id,
            'item_description' =>'Admission Bill',
            'amount' =>  $request->bill,
            'status' => 'NYP'
            );
            InvoiceItem::create($data);

        $inpatient->invoice()->save($invoice);
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
