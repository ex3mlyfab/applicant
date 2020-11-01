<?php

namespace App\Http\Controllers\Admin\Front;

use App\Http\Controllers\Controller;
use App\Models\BankTransfer;
use App\Models\Family;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\MdAccount;
use App\Models\PatientStatistic;
use App\Models\Payment;
use App\Models\PaymentMode;
use App\Models\PaymentReceipt;
use App\Models\RegistrationType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = Family::all();

        return view('admin.patient.allfamil', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $families = RegistrationType::where('name', 'Like', 'family%')->get();
        $paymentmode = PaymentMode::all();
        return view('admin.patient.family', compact('families', 'paymentmode'));
        //
    }

    public function familyEnroll(Family $family)
    {
        return view('admin.patient.familyenroll', compact('family'));
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
        // dd($request->except('_token'));
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'other_names' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users',
            'sex' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'nok' => 'nullable|max:255',
            'nok_phone' => 'nullable|max:255',
            'nok_relationship' => 'nullable|string|max:255',
            'nok_address' => 'nullable|string',
            'address' => 'nullable|string',
            'nationality' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'age_at_reg' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'registration_type_id' => 'nullable',
            'occupation' => 'nullable',
            'tribe' => 'nullable',
            'religion' => 'sometimes',
            'referral_source' => 'sometimes',
            'insurance_number' => 'nullable',
            'payment_method' => 'nullable',
            'dob' => 'sometimes',
            'payment_mode' => 'sometimes',
            'belongs_to' =>'sometimes',
        ]);

        if ($request->has('dob')) {
            $dob = strtotime($request->dob);
            $newDate = date('Y-m-d', $dob);
            $newDate = Carbon::parse($newDate);
            $validated['dob'] = $newDate;
        }


        $validated['source'] = 'family';

        if ($request->has('belongs_to')) {
            $number = Family::where('id', $request->belongs_to)->first();

            $getletter = num_to_letters(($number->enrolment_count + 1));
            $validated['folder_number'] = $number->folder_number . $getletter;
            $number->update([
                'enrolment_count' => $number->enrolment_count + 1,
            ]);

        }
        if ($request->has('avatar')) {
            //
            $image = $request->avatar;  // your base64 encoded

            // $image = str_replace('data:image/png;base64,', '', $image);

            // $image = str_replace(' ', '+', $image);
            @list($type, $file_data) = explode(';', $image);
            @list(, $file_data) = explode(',', $file_data);
            $storage_path = public_path() . '/backend/images/avatar';
            $imageName = $request->last_name . $request->other_names . Date('Y-m-d') . '.' . 'png';
            $validated['avatar'] = $imageName;
            \File::put($storage_path . '/' . $imageName, base64_decode($file_data));
        }


        $validated['password'] = Hash::make('pentacare');
        $validated['registered_by'] = Auth::user()->id;
        $anchor = User::create($validated);

        if (!($request->has('belongs_to'))) {
            $id = Family::create([
                'enrolment_count' => 1,
                'folder_number' => assign_Fno($request->registration_type_id),
                'registration_type_id' => $request->registration_type_id,
                'user_id' => $anchor->id,
            ]);
            $f_update = PatientStatistic::where('registration_type_id', $id->registrationType->id)->whereYear('year', date('Y'))->first();
            $f_update->increment('number', 1);
            $anchor->update([
                'folder_number' => $id->folder_number . num_to_letters(1),
                'belongs_to' => $id->id,
            ]);
            switch ($request->payment_mode) {
                case 2:
                    BankTransfer::create([
                        'bank_id' => $request->transfer_id,
                        'user_id' => $anchor->id,
                        'amount_transfered' => $id->registrationType->charge->amount,
                        'status' => 'POS'
                    ]);
                    $paid = PaymentReceipt::create([
                        'user_id' => $anchor->id,
                        'payment_mode_id' => $request->payment_mode,
                        'admin_id' => auth()->user()->id,
                        'receipt_no' => generate_invoice_no(),
                        'total' => $id->registrationType->charge->amount,
                    ]);
                    Payment::create([
                        'payment_receipt_id' => $paid->id,
                        'service' => 'Payments for new ' . $id->registrationType->name . ' registration',
                        'amount' => $id->registrationType->charge->amount,

                        ]);
                    $id->payments()->save($paid);
                    break;
                case 1:
                    $paid = PaymentReceipt::create([
                        'user_id' => $anchor->id,
                        'payment_mode_id' => $request->payment_mode,
                        'admin_id' => auth()->user()->id,
                        'receipt_no' => generate_invoice_no(),
                        'total' => $id->registrationType->charge->amount,
                    ]);
                    Payment::create([
                        'payment_receipt_id' => $paid->id,
                        'service' => 'Payments for new ' . $id->registrationType->name . ' registration',
                        'amount' => $id->registrationType->charge->amount,

                        ]);
                    $id->payments()->save($paid);

                    break;
                case 3:
                    BankTransfer::create([
                        'bank_id' => $request->transfer_id,
                        'user_id' => $anchor->id,
                        'amount_transfered' => $id->registrationType->charge->amount,
                        'status' => 'Transfer'
                    ]);
                    $paid = PaymentReceipt::create([
                        'user_id' => $anchor->id,
                        'payment_mode_id' => $request->payment_mode,
                        'admin_id' => auth()->user()->id,
                        'receipt_no' => generate_invoice_no(),
                        'total' => $id->registrationType->charge->amount,
                    ]);
                    Payment::create([
                        'payment_receipt_id' => $paid->id,
                        'service' => 'Payments for new ' . $id->registrationType->name . ' registration',
                        'amount' => $id->registrationType->charge->amount,

                        ]);
                    $id->payments()->save($paid);

                    break;
                case 4 :

                    MdAccount::create([
                        'user_id' =>$anchor->id
                    ]);
                    $anchor->mdAccount->mdAccountCharges()->create([
                        'service' => 'registration',
                        'charge'  => $id->registrationType->charge->amount ,
                        'patient_paid' => 0,
                        'md_covers'=>$id->registrationType->charge->amount ,

                    ]);

                    break;
                case 5 :
                    $invoice= Invoice::create([
                        'user_id' => $anchor->id,
                        'invoice_no' => generate_invoice_no(),
                        'amount' => $id->registrationType->charge->amount ,
                        'admin_id' => auth()->user()->id,
                        'p_status' => 'NYP',
                        'status' => 'credit'
                    ]);

                    $anchor->invoice()->save($invoice);

                    $invoice->invoiceItems()->create([
                        'item_description' => 'New Registration Charge ',
                        'amount' => number_format($id->registrationType->charge->amount, 2, '.', '') ,
                        'status' => 'NYP'
                    ]);

                    break;
                default:
                    # code...
                    break;
            }


        }

        $notification = array(
            'message' => 'Family account created successfully!',
            'alert-type' => 'success'
        );

        return redirect('admin/family')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Family $family)
    {
        //
        return view('admin.patient.familyshow', compact('family'));
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
    public function destroy(Family $family)
    {
        foreach ($family->users as $value) {
            $value->delete();
        }
        $family->delete();
        $notification = [
            'message' => 'family account deleted succesfully',
            'alert-type' => 'info'
        ];
        return back()->with($notification);
    }
}
