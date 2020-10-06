<?php

namespace App\Http\Controllers\Admin\Front;

use App\Http\Controllers\Controller;
use App\Models\BankTransfer;
use App\Models\ClinicalAppointment;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Charge;
use App\Models\Invoice;
use App\Models\Payment;
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
        return view('admin.appointment.bookappointment', compact('patient', 'charge'));
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

        $admin_id = auth()->user()->id;



        $validated['appointment_due'] = now()->today();
        $validated['payment_id'] = 1;

        $validated['status'] = "waiting";
        $appointment = ClinicalAppointment::create($validated);
        if($request->has('charges')){
            switch ($request->payment_method) {
            case 'insurance':
                $invoice =  Invoice::whereDate('created_at', now()->today())->where('user_id', $request->pateient_id)->first();
                if(!$invoice){
                    $invoice = Invoice::create([
                        'user_id' => $request->patient_id,
                        'invoice_id' => generate_invoice_no(),
                        'amount' => $request->charges,
                    ]);
                }
                if($request->coverage < 100){
                    $invoice->invoiceItems()->createMany([
                        'item_description' => 'Consultation patient charge '.(100 - $request->coverage).'%',
                        'amount' => $request->charges,
                        'status' => 'NYP'
                    ],
                    [
                        'item_description' => 'consultation Insurance cover '. $request->coverage. '%',
                        'amount' => $request->coverage/100 * $request->original_charge,
                        'status' => 'NYP'
                    ]
                    );

                }else{
                    $invoice->invoiceItems()->create([
                        'item_description' => 'consultation Insurance cover '. $request->coverage. '%',
                        'amount' => $request->coverage/100 * $request->original_charge,
                        'status' => 'NYP'
                    ]);
                }
                $appointment->user->userEnroll->insurancePackage->invoice()->save($invoice);
                break;
            case 'mdaccount':

                $invoice =  Invoice::whereDate('created_at', now()->today())->where('user_id', $request->pateient_id)->first();
                    if(!$invoice){
                    $invoice = Invoice::create([
                        'user_id' => $request->patient_id,
                        'invoice_no' => generate_invoice_no(),
                        'amount' => $request->charges,
                    ]);
                    }
                    $invoice->invoiceItems()->create([
                        'item_description' => 'consultation Insurance cover '. $request->coverage. '%',
                        'amount' => $request->coverage/100 * $request->original_charge,
                        'status' => 'md account'
                    ]);
                if($request->coverage < 100){
                    switch ($request->payment_mode) {
                        case 1:
                            Payment::create([
                                'payment_mode_id' => $request->payment_mode,
                                'user_id' => $request->patient_id,
                                'admin_id' => auth()->user()->id,
                                'service' => 'Payments for Consultation',
                                'amount' => $request->charges,
                                'invoice_no' => generate_invoice_no(),
                                ]);
                            break;
                        case 2:
                            BankTransfer::create([
                                'bank_id' => $request->transfer_id,
                                'user_id' => $appointment->user->id,
                                'amount_transfered' => $request->charges,
                                'status' => 'POS'
                            ]);
                            Payment::create([
                                'payment_mode_id' => $request->payment_mode,
                                'user_id' => $request->patient_id,
                                'admin_id' => auth()->user()->id,
                                'service' => 'Payments for Consultation',
                                'amount' => $request->charges,
                                'invoice_no' => generate_invoice_no(),
                                ]);
                            break;
                        case 3 :
                            BankTransfer::create([
                                'bank_id' => $request->transfer_id,
                                'user_id' => $appointment->user->id,
                                'amount_transfered' => $request->charges,
                                'status' => 'Transfer'
                            ]);
                            Payment::create([
                                'payment_mode_id' => $request->payment_mode,
                                'user_id' => $request->patient_id,
                                'admin_id' => auth()->user()->id,
                                'service' => 'Payments for Consultation',
                                'amount' => $request->charges,
                                'invoice_no' => generate_invoice_no(),
                                ]);
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
                $appointment->user->mdAccount->invoice()->save($invoice);
                break;
            case 'pocket':

                switch ($request->payment_mode) {
                    case 1:
                        Payment::create([
                            'payment_mode_id' => $request->payment_mode,
                            'user_id' => $request->patient_id,
                            'admin_id' => auth()->user()->id,
                            'service' => 'Payments for Consultation',
                            'amount' => $request->charges,
                            'invoice_no' => generate_invoice_no(),
                            ]);
                        break;
                    case 2:
                        BankTransfer::create([
                            'bank_id' => $request->transfer_id,
                            'user_id' => $appointment->user->id,
                            'amount_transfered' => $request->charges,
                            'status' => 'POS'
                        ]);
                        Payment::create([
                            'payment_mode_id' => $request->payment_mode,
                            'user_id' => $request->patient_id,
                            'admin_id' => auth()->user()->id,
                            'service' => 'Payments for Consultation',
                            'amount' => $request->charges,
                            'invoice_no' => generate_invoice_no(),
                            ]);
                        break;
                    case 3 :
                        BankTransfer::create([
                            'bank_id' => $request->transfer_id,
                            'user_id' => $appointment->user->id,
                            'amount_transfered' => $request->charges,
                            'status' => 'Transfer'
                        ]);
                        Payment::create([
                            'payment_mode_id' => $request->payment_mode,
                            'user_id' => $request->patient_id,
                            'admin_id' => auth()->user()->id,
                            'service' => 'Payments for Consultation',
                            'amount' => $request->charges,
                            'invoice_no' => generate_invoice_no(),
                            ]);
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
