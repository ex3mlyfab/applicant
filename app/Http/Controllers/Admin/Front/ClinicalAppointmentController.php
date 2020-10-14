<?php

namespace App\Http\Controllers\Admin\Front;

use App\Http\Controllers\Controller;
use App\Models\BankTransfer;
use App\Models\ClinicalAppointment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Charge;
use App\Models\EnrollCharge;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Models\PaymentReceipt;
use Auth;
use Carbon\Carbon;
class ClinicalAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = ClinicalAppointment::all();
        $today = $appointments->where('appointment_due', Carbon::today());
        $patients = User::all();


        $charge = Charge::where('name', 'Consultation')->first();

        return view('admin.appointment.index', compact('appointments', 'patients', 'charge', 'today'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }
    public function bookConsultation(User $patient)
    {
        $charge = Charge::where('name', 'Consultation')->first();
        $coverage = $patient->payment_method;
        $due_payment = 0;

        switch ($coverage) {
            case 'mdaccount':
                $percentile =$patient->mdAccount->mdAccountCovers->where('name', 'consultation')->first();

                if(($percentile && (($percentile->ends == NULL) ||(now()->between($percentile->starts, $percentile->ends))))){
                    if($percentile->percentage < 100)
                    {
                        $message = "MD covers ".$percentile->percentage."% of charges";
                        $due_payment= $charge->amount - $percentile->percentage/100 * $charge->amount;
                        $percentage = $percentile->percentage;
                    } else{
                        $message = "MD covers ".$percentile->percentage."% of charges";
                        $due_payment = 0;
                        $percentage = $percentile->percentage;
                    }
                }
                else{
                    $percentage = 0;
                    $message = '';
                    $due_payment = $charge->amount;
                }
                break;
            case 'insured':
                $percentile = $patient->enrollUser->insurancePackage;
                $covered= $percentile->insuranceServices->where('service_type','consultation' )->first();
                if($covered->service_type === 'consultation'){
                    if($percentile->percentage < 100){
                        $message = "insurance enrollee at ".$percentile->percentage."% of charges";
                        $due_payment= $charge->amount - ($percentile->percentage/100 * $charge->amount);
                        $percentage = $percentile->percentage;
                        // dd($due_payment);
                    }else{
                        $message = "insurance enrollee at ".$percentile->percentage."% of charges";
                        $due_payment = 0;
                        $percentage = $percentile->percentage;
                    }
                }else{
                    $message = "insurance enrollee out of coverage";
                    $due_payment = $charge->amount;
                    $percentage = $percentile->percentage;

                }
            break;
            case 'pocket':
            $message = '';
            $due_payment = $charge->amount;
            $percentage = 0;
                break;
        }
        // dd($due_payment, $message);
        return view('admin.appointment.bookappointment', compact('patient', 'charge', 'message', 'due_payment', 'percentage'));
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
        $validated = $request->validate([
            'patient_id' => 'required',
            'to_see' => 'nullable',

        ]);



        $validated['appointment_due'] = now()->today();
        $validated['payment_id'] = 1;

        $validated['status'] = "waiting";
        $appointment = ClinicalAppointment::create($validated);
        // dd($appointment->user->payment_method);
        if($request->has('charges')){
            switch ($appointment->user->payment_method) {
            case 'insured':



                if($request->coverage < 100){
                    $invoice = Invoice::create([
                        'user_id' => $request->patient_id,
                        'invoice_no' => generate_invoice_no(),
                        'amount' => $request->charges,
                        'p_status' => 'NYP',
                        'status' => 'consultation',
                        'admin_id' => auth()->user()->id,
                    ]);
                    InvoiceItem::create([
                        'invoice_id' => $invoice->id,
                        'item_description' => 'Consultation patient charge '.(100 - $request->coverage).'%',
                        'amount' => $request->charges,
                        'status' => 'NYP'
                    ]);
                    EnrollCharge::create([
                        'enroll_user_id' => $appointment->user->enrollUser->id,
                        'service' => 'consultation',
                        'charge' => $request->original_charge,
                        'patient_paid' => $request->charges,
                        'insurance_cover' =>  $request->coverage/100 * $request->original_charge,
                        'payment_status' => 'NYP'
                    ]);
                    $appointment->user->enrollUser->insurancePackage->invoice()->save($invoice);

                }else{
                    $appointment->user->enrollUser->enrollCharges()->create([
                        'service' => 'consultation',
                        'charge' => $request->original_charge,
                        'patient_paid' => $request->charges,
                        'insurance_cover' =>  $appointment->user->enrollUser->insurancePackage->coverage/100 * $request->original_charge,
                        'payment_status' => 'NYP'
                    ]);
                }

                break;
            case 'mdaccount':
                    $appointment->user->mdAccount->mdAccountCharges()->create([
                        'service' => 'consultation',
                        'charge'  => $request->original_charge,
                        'patient_paid' => $request->charges,
                        'md_covers'=>$request->coverage/100 * $request->original_charge,

                    ]);

                    if($request->coverage < 100){

                    switch ($request->payment_mode) {
                        case 1:
                           $paid = PaymentReceipt::create([
                                'user_id' => $request->patient_id,
                                'payment_mode_id' => $request->payment_mode,
                                'admin_id' => auth()->user()->id,
                                'receipt_no' => generate_invoice_no(),
                                'total' => $request->charges
                            ]);
                            Payment::create([
                                'payment_receipt_id' => $paid->id,
                                'service' => 'Payments for Consultation',
                                'amount' => $request->charges,

                                ]);
                            $appointment->payments()->save($paid);
                            break;
                        case 2:
                            BankTransfer::create([
                                'bank_id' => $request->transfer_id,
                                'user_id' => $appointment->user->id,
                                'amount_transfered' => $request->charges,
                                'status' => 'POS'
                            ]);
                            $paid = PaymentReceipt::create([
                                'user_id' => $request->patient_id,
                                'payment_mode_id' => $request->payment_mode,
                                'admin_id' => auth()->user()->id,
                                'receipt_no' => generate_invoice_no(),
                                'total' => $request->charges
                            ]);
                            Payment::create([
                                'payment_receipt_id' => $paid->id,
                                'service' => 'Payments for Consultation',
                                'amount' => $request->charges,

                                ]);
                            $appointment->payments()->save($paid);
                            break;
                        case 3 :
                            BankTransfer::create([
                                'bank_id' => $request->transfer_id,
                                'user_id' => $appointment->user->id,
                                'amount_transfered' => $request->charges,
                                'status' => 'Transfer'
                            ]);
                            $paid = PaymentReceipt::create([
                                'user_id' => $request->patient_id,
                                'payment_mode_id' => $request->payment_mode,
                                'admin_id' => auth()->user()->id,
                                'receipt_no' => generate_invoice_no(),
                                'total' => $request->charges
                            ]);
                            Payment::create([
                                'payment_receipt_id' => $paid->id,
                                'service' => 'Payments for Consultation',
                                'amount' => $request->charges,

                                ]);
                            $appointment->payments()->save($paid);
                            break;
                        case  4:
                            $appointment->user->retainership()->create([
                                'credit' => $request->charges,
                                'comment' => 'New consultaion charge',
                                'balance' => number_format($appointment->user->retainership_balance - $request->charges,2, '.', ''),
                            ]);
                            break;

                        default:
                            # code...
                            break;
                    }
                }

                break;
            case 'pocket':

                switch ($request->payment_mode) {
                    case 1:
                        $paid = PaymentReceipt::create([
                            'user_id' => $request->patient_id,
                            'payment_mode_id' => $request->payment_mode,
                            'admin_id' => auth()->user()->id,
                            'receipt_no' => generate_invoice_no(),
                            'total' => $request->charges
                        ]);
                        Payment::create([
                            'payment_receipt_id' => $paid->id,
                            'service' => 'Payments for Consultation',
                            'amount' => $request->charges,

                            ]);
                        $appointment->payments()->save($paid);
                        break;
                    case 2:
                        BankTransfer::create([
                            'bank_id' => $request->transfer_id,
                            'user_id' => $appointment->user->id,
                            'amount_transfered' => $request->charges,
                            'status' => 'POS'
                        ]);
                        $paid = PaymentReceipt::create([
                                'user_id' => $request->patient_id,
                                'payment_mode_id' => $request->payment_mode,
                                'admin_id' => auth()->user()->id,
                                'receipt_no' => generate_invoice_no(),
                                'total' => $request->charges
                            ]);
                            Payment::create([
                                'payment_receipt_id' => $paid->id,
                                'service' => 'Payments for Consultation',
                                'amount' => $request->charges,

                                ]);
                            $appointment->payments()->save($paid);
                        break;
                    case 3 :
                        BankTransfer::create([
                            'bank_id' => $request->transfer_id,
                            'user_id' => $appointment->user->id,
                            'amount_transfered' => $request->charges,
                            'status' => 'Transfer'
                        ]);
                        $paid = PaymentReceipt::create([
                                'user_id' => $request->patient_id,
                                'payment_mode_id' => $request->payment_mode,
                                'admin_id' => auth()->user()->id,
                                'receipt_no' => generate_invoice_no(),
                                'total' => $request->charges
                            ]);
                            Payment::create([
                                'payment_receipt_id' => $paid->id,
                                'service' => 'Payments for Consultation',
                                'amount' => $request->charges,

                                ]);
                            $appointment->payments()->save($paid);
                        break;
                    case  4:
                        $appointment->user->retainership()->create([
                            'credit' => $request->charges,
                            'comment' => 'New consultaion charge',
                            'balance' => number_format($appointment->user->retainership_balance - $request->charges,2, '.', ''),
                        ]);
                        break;

                    default:
                        # code...
                        break;
                }
                break;

            default:
                # code...
                break;
        }

        }



        $notification = array(
            'message' => 'Appointment created successfully!',
            'alert-type' => 'success'
        );

        return redirect('admin/clinicalappointment')->with($notification);
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
