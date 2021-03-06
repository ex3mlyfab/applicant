<?php

namespace App\Http\Controllers\Admin\Inpatient;

use App\Http\Controllers\Controller;
use App\Models\AdmitModel;
use App\Models\Bed;
use App\Models\Charge;
use App\Models\Consult;
use App\Models\Encounter;
use App\Models\Inpatient;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Retainership;
use App\Models\VitalSign;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
       $fluidstory = $inpatient->fluidReportDetails->groupBy(function($item){

        return \Carbon\Carbon::parse($item->done_at)->format('d/M/Y');
     } );


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
        return view('admin.inpatient.create', compact('fluidstory',
            'dataChart', 'vitals', 'inpatient','encounter'));
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
            'status' => 'admission',
            'admin_id' => auth()->user()->id,
        ]);
        $inpatient->inpatientBill()->create([
            'bill' =>$request->bill,
            'p_status' => 'NYP'
        ]);
        $inpatient->inpatientBill->inpatientBillDetails()->create([
            'service' => 'Initial Bill',
            'amount' => $request->bill
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
    public function billUpdate(Inpatient $inpatient)
    {
        $current = Carbon::now();
        $days = $current->diffInDays(Carbon::parse($inpatient->date_of_admission)) + 1;
        $bedcost = 6000;
        $doctorscost = Charge::where('name', 'Doctors Charge')->first()->amount;
        $nursecost = Charge::where('name', 'Nursing charge')->first()->amount ;
        $doctorsCharge = $inpatient->inpatientBill->inpatientBillDetails->filter(function($value){
            return $value->service == 'Doctors Charge';
        });
        $accomodation = $inpatient->inpatientBill->inpatientBillDetails->filter(function($value){
            return $value->service == 'Accomodation';
        });
        $nurseCharge = $inpatient->inpatientBill->inpatientBillDetails->filter(function($value){
            return $value->service == 'Nursing Charge';
        });
        if($nurseCharge->count()=== 0){
            $inpatient->inpatientBill->inpatientBillDetails()->create([
                'service' => 'Nursing Charge',
                'amount' => (double)($days * $nursecost),
            ]);
        }else{
            $nurseCharge->first()->update([
                'amount' =>(double)($days * $nursecost)
            ]);
        }
        if($doctorsCharge->count() === 0){
            $inpatient->inpatientBill->inpatientBillDetails()->create([
                'service' => 'Doctors Charge',
                'amount' =>(double)($days * $doctorscost),
            ]);
        }else{
            $doctorsCharge->first()->update([
                'amount' => (double)($days * $doctorscost),
            ]);
         }
         if($accomodation->count() === 0){
            $inpatient->inpatientBill->inpatientBillDetails()->create([
                'service' => 'Accomodation',
                'amount' => (double)($days * $bedcost),
            ]);
         }else{
             $accomodation->first()->update([
                 'amount' => (double)($days * $bedcost),
             ]);
         }
        //  dd($accomodation, $doctorsCharge, $nurseCharge);
        return view('admin.inpatient.inpatientbill', compact('inpatient', 'days'));

    }

    public function addBill(Request $request, Inpatient $inpatient)
    {
        // dd($request->except('_token'));
        $serviceable = $request->service_select;
        $charges = $inpatient->inpatientBill->inpatientBillDetails->filter(function($value) use ($serviceable){
            return $value->service ==  $serviceable;
        });

        if($charges->count() === 0){
            $inpatient->inpatientBill->inpatientBillDetails()->create([
                'service' => $serviceable,
                'amount' =>(double)($request->amount),
            ]);
        }else{
            $initials = $charges->first()->amount;
            $charges->first()->update([
                'amount' => (double)($request->amount + $initials),
            ]);
         }
         $notification =  [
             'message' => 'Bill Updated succesfully',
             'alert-type' => 'success'
         ];
         return back()->with($notification);

    }
    public function updateInvoice(Request $request, Inpatient $inpatient)
    {
     if($request->has('confirm_discharge')){
         $inpatient->update([
            'status' => 'discharged',
            'date_of_discharge' => now()
         ]);
         $inpatient->bed()->update([
            'status' => '',
        ]);
     }


     $outstanding = ($inpatient->inpatientBill->inpatientBillDetails->filter(function($item){
        return $item->service != 'Initial Bill';
    })->sum('amount')
    - $inpatient->inpatientBill->inpatientBillDetails->filter(function($item){
        return $item->service == 'Initial Bill';
    })->sum('amount') + $inpatient->invoice->invoiceItems->filter(function($item){
        return strpos($item->item_description, 'Part-payment');
    })->sum('amount'));

    $balance = $inpatient->invoice->invoiceItems->filter(function($value){
                return $value->item_description == 'Balance';
                    });
        if($balance->count()){
            $balance->first()->update([
                'amount' => (double) $outstanding,
                'status' => 'NYP'
            ]);
        }else{
            $inpatient->invoice->invoiceItems()->create([
                'item_description' =>'Balance',
                'amount' =>  $outstanding,
                'status' => 'NYP'
            ]);
        }
        $inpatient->invoice->update([
            'amount' => $outstanding,
        ]);
    return redirect()->route('inpatient.index');

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
