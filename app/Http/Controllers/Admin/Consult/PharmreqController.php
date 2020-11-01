<?php

namespace App\Http\Controllers\Admin\Consult;

use App\Http\Controllers\Controller;
use App\Models\Consult;
use App\Models\ConsultTest;
use App\Models\EnrollCharge;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\PharmacyBill;
use App\Models\PharmacyBillDetail;
use App\Models\Pharmreq;
use App\Models\PharmreqDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PharmreqController extends Controller
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
    public function prepare(Request $request, Pharmreq $pharmreq)
    {
        $haempay = Pharmreq::findOrFail($request->pharmreq_id);
        $data = $request->except('_token');
        $invoice = Invoice::where('user_id', $haempay->clinicalAppointment->user->id)->where('created_at', now()->today())->first();
        if (!(isset($invoice))) {
            $invoice =  Invoice::create([
                'user_id' => $haempay->clinicalAppointment->user->id,
                'invoice_no' => generate_invoice_no(),

            ]);
        }


        $pharmbill = PharmacyBill::create([
            'user_id' => $haempay->clinicalAppointment->user->id,
            'consultant_id' => $haempay->seen_by,
            'pharmacist_id' => Auth::user()->id,
            'amount' => $request->amount,
            'discount' => 0,
            'vat' => 0,
            'gross_amount' => $request->amount,
            'status' => 'NYP',
            'payment_method' => 'cash',

        ]);
        foreach ($request->drugmodel as $key => $value) {
            PharmacyBillDetail::create([
                'pharmacybill_id' => $pharmbill->id,
                'drug_model_id' => $request->drugmodel[$key],
                'batch_no' => $request->batch_no[$key],
                'quantity' => $request->quantity[$key],
                'unit_cost' => $request->unit_cost[$key],
                'amount' => $request->drug_cost[$key],
            ]);
        }
        $haempay->update([
            'status' => 'invoice generated',
        ]);
        $notification = [
            'message' => 'Invoice Generated Successfully',
            'alert-type' => 'success'
        ];
        return json_encode($notification);
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
        // dd($request->all)

        $pc = Pharmreq::create([
            'encounter_id' => $request->encounter_id,
            'status'=> 'invoice generated',
            'total' => $request->totalBalance,
            'seen_by' => auth()->user()->id,
        ]);
        foreach ($request->drug_model_id as $key => $medicine_id) {
            $data = array(
                'pharmreq_id' => $pc->id,
                'drug_model_id' => $request->drug_model_id[$key],
                'dosage' => $request->dosage[$key],
                'duration' => $request->duration[$key],
                'quantity' => $request->quantity[$key],
                'cost' => $request->linecost[$key],

            );
         PharmreqDetail::create($data);
        }

        switch ($pc->encounter->user->payment_method) {
            case 'insured':
                $percentile =$pc->encounter->user->enrollUser->insurancePackage;
                if($percentile->percentage < 100){
                    $invoice = Invoice::create([
                        'user_id' =>$pc->encounter->user->id,
                        'invoice_no' => generate_invoice_no(),
                        'amount' => (100 - $percentile->percentage) /100 * $pc->total,
                        'p_status' => 'NYP',
                        'status' => 'pharmacy',
                        'admin_id' => auth()->user()->id,
                    ]);
                    foreach ($pc->pharmreqDetails as $key => $value) {
                        $data = array(
                        'invoice_id' => $invoice->id,
                        'item_description' =>'Pharmacy - '. $value->drugModel->name,
                        'amount' => (100 - $percentile->percentage) /100 *  $value->cost,
                        'status' => 'NYP'
                        );
                        $just=InvoiceItem::create($data);
                        $value->update([
                            'invoice_item_id' => $just->id,
                        ]);
                    }
                    EnrollCharge::create([
                        'enroll_user_id' => $pc->encounter->user->enrollUser->id,
                        'service' => 'pharmacy',
                        'charge' => $pc->total,
                        'patient_paid' =>(100 - $percentile->percentage) /100 * $pc->total,
                        'insurance_cover' =>  $percentile->percentage/100 * $pc->total,
                        'payment_status' => 'NYP'
                    ]);
                    $pc->invoice()->save($invoice);

                }else{
                    EnrollCharge::create([
                        'enroll_user_id' => $pc->encounter->user->enrollUser->id,
                        'service' => 'pharmacy',
                        'charge' => $pc->total,
                        'patient_paid' =>(100 - $percentile->percentage) /100 * $pc->total,
                        'insurance_cover' =>  $percentile->percentage/100 * $pc->total,
                        'payment_status' => 'NYP'
                    ]);
                    $pc->update([
                        'status' => 'item paid'
                    ]);
                    $pc->pharmreqDetails->transform(function($item){
                        $item->update([
                            'status' => 'insurance'
                        ]);
                    });
                    // $pc->pharmreqDetails->
                }

                break;
            case 'mdaccount':
                $percentile =$pc->encounter->user->mdAccount->mdAccountCovers->where('name', 'pharmacy')->first();
                if(($percentile && (($percentile->ends == NULL) ||(now()->between($percentile->starts, $percentile->ends))))){
                    if($percentile->percentage < 100)
                    {
                        $invoice = Invoice::create([
                            'user_id' =>$pc->encounter->user->id,
                            'invoice_no' => generate_invoice_no(),
                            'amount' => (100 - $percentile->percentage) /100 * $pc->total,
                            'p_status' => 'NYP',
                            'status' => 'pharmacy',
                            'admin_id' => auth()->user()->id,
                        ]);
                        foreach ($pc->pharmreqDetails as $key => $value) {
                            $data = array(
                            'invoice_id' => $invoice->id,
                            'item_description' =>'Pharmacy - '. $value->drugModel->name,
                            'amount' => (100 - $percentile->percentage) /100 *  $value->cost,
                            'status' => 'NYP'
                            );
                            $just = InvoiceItem::create($data);
                            $value->update([
                                'invoice_item_id' => $just->id,
                            ]);
                        }
                        $pc->encounter->user->mdAccount->mdAccountCharges()->create([
                            'service' => 'pharmacy',
                            'charge'  => $pc->total,
                            'patient_paid' => (100 - $percentile->percentage) /100 * $pc->total,
                            'md_covers'=>($percentile->percentage) /100 * $pc->total,

                        ]);
                        $pc->invoice()->save($invoice);
                    } else{
                        $pc->encounter->user->mdAccount->mdAccountCharges()->create([
                            'service' => 'pharmacy',
                            'charge'  => $pc->total,
                            'patient_paid' => (100 - $percentile->percentage) /100 * $pc->total,
                            'md_covers'=>($percentile->percentage) /100 * $pc->total,

                        ]);
                        $pc->update([
                            'status' => 'item paid'
                        ]);
                        $pc->pharmreqDetails->transform(function($item){
                            $item->update([
                                'status' => 'mdaccount'
                            ]);
                        });
                    }
                }
                else{
                    $invoice = Invoice::create([
                        'user_id' =>$pc->encounter->user->id,
                        'invoice_no' => generate_invoice_no(),
                        'amount' => $pc->total,
                        'p_status' => 'NYP',
                        'status' => 'pharmacy',
                        'admin_id' => auth()->user()->id,
                    ]);
                    foreach ($pc->pharmreqDetails as $key => $value) {
                        $data = array(
                        'invoice_id' => $invoice->id,
                        'item_description' =>'Pharmacy - '. $value->drugModel->name,
                        'amount' =>  $value->cost,
                        'status' => 'NYP'
                        );
                        $just = InvoiceItem::create($data);
                        $value->update([
                            'invoice_item_id' => $just->id
                        ]);
                    }
                    $pc->invoice()->save($invoice);
                }
                break;
            case 'pocket':
                $invoice = Invoice::create([
                    'user_id' =>$pc->encounter->user->id,
                    'invoice_no' => generate_invoice_no(),
                    'amount' => $pc->total,
                    'p_status' => 'NYP',
                    'status' => 'pharmacy',
                    'admin_id' => auth()->user()->id,
                ]);
                foreach ($pc->pharmreqDetails as $key => $value) {
                    $data = array(
                    'invoice_id' => $invoice->id,
                    'item_description' =>'Pharmacy - '. $value->drugModel->name,
                    'amount' =>  $value->cost,
                    'status' => 'NYP'
                    );
                   $just = InvoiceItem::create($data);
                    $value->update([
                        'invoice_item_id' => $just->id
                    ]);
                }
                $pc->invoice()->save($invoice);
                break;

            default:
                # code...
                break;
        }



        $pc->testable()->create([
            'encounter_id' => $pc->encounter_id,
            'status' => 'invoice generated',
        ]);

        $notification = array(
            'message' => 'Pharmacy request sent successfully!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }


    public function ajaxdrug(Request $request)
    {
        $validated = $request->except('_token');
        $pc = Pharmreq::create([
            'clinical_appointment_id' => $request->clinical_appointment,
            'seen_by' => Auth::user()->id,
        ]);
        $status = $pc->clinical_appointment_id;
        foreach ($request->drug_model_id as $key => $medicine_id) {
            $data = array(
                'pharmreq_id' => $pc->id,
                'drug_model_id' => $request->drug_model_id[$key],
                'dosage' => $request->dosage[$key],
                'duration' => $request->instruction[$key],
                'quantity' => 0,


            );
            PharmreqDetail::insert($data);
        }

        $consult = Consult::firstOrCreate(['clinical_appointment_id' => $status]);
        $created = $pc->labinfos()->create([
            'consult_id' => $consult->id,
            'type' => 'Drug Prescription',
            'status' => 'waiting',
        ]);


        return json_encode($created);
    }
    public function prescriptionReview(Pharmreq $pharmreq){

        return view('admin.pharmacy.prescription', compact('pharmreq'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pharmreq $pharmreq)
    {
        $prescribed = $pharmreq->pharmreqDetails;
        $inserted = [];
        foreach ($prescribed as $key => $value) {
            array_push($inserted,[
                'drugName' =>$value->drugModel->name,
                'drug_form'=> $value->drugModel->forms. '/'. $value->drugModel->strength,
                'dosage'   => $value->dosage,
                'duration' => $value->duration,
                'cost' => $value->cost,
                'quantity' =>$value->quantity
            ]);
        }
        $data= [
            'pharmreq' => $pharmreq,
            'prescription' => $inserted,
            'prescribed-by' => $pharmreq->seenBy->name

        ];
        return response()->json($data);
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
