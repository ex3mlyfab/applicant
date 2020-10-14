<?php

namespace App\Http\Controllers\Admin\Front;

use App\Http\Controllers\Controller;
use App\Models\BankTransfer;
use App\Models\Organization;
use App\Models\Payment;
use App\Models\PaymentReceipt;
use App\Models\RegistrationType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Organization::all();
        return view('admin.patient.company', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = RegistrationType::where('name', 'like', 'Company%')->get();
        return view('admin.patient.companycreate', compact('companies'));
    }
    public function enroll(Organization $company)
    {
        return view('admin.patient.companyenroll', compact('company'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'registration_type_id' => 'required',
            'organisation_name' => 'required|unique:organizations',
            'address' => 'nullable',
            'contact_phone' => 'nullable',
        ]);
        $data['folder_number'] = assign_Fno_company();

        $org = Organization::create($data);
        switch ($request->payment_mode) {
                case 2:
                    BankTransfer::create([
                        'bank_id' => $request->transfer_id,
                        'name' => $org->organization_name,
                        'amount_transfered' => $org->registrationType->charge->amount,
                        'status' => 'POS'
                    ]);
                    $paid = PaymentReceipt::create([
                        'name' => $org->organization_name,
                        'payment_mode_id' => $request->payment_mode,
                        'admin_id' => auth()->user()->id,
                        'receipt_no' => generate_invoice_no(),
                        'total' => $org->registrationType->charge->amount,
                    ]);
                    Payment::create([
                        'payment_receipt_id' => $paid->id,
                        'service' => 'Payments for new ' . $org->registrationType->name . ' registration',
                        'amount' => $org->registrationType->charge->amount,

                        ]);
                    $org->payments()->save($paid);
                    break;
                case 1:
                    $paid = PaymentReceipt::create([
                        'name' => $org->organization_name,
                        'payment_mode_id' => $request->payment_mode,
                        'admin_id' => auth()->user()->id,
                        'receipt_no' => generate_invoice_no(),
                        'total' => $org->registrationType->charge->amount,
                    ]);
                    Payment::create([
                        'payment_receipt_id' => $paid->id,
                        'service' => 'Payments for new ' . $org->registrationType->name . ' registration',
                        'amount' => $org->registrationType->charge->amount,

                        ]);
                    $org->payments()->save($paid);
                    break;
                case 3:
                    BankTransfer::create([
                        'bank_id' => $request->transfer_id,
                        'name' => $org->organization_name,
                        'amount_transfered' => $org->registrationType->charge->amount,
                        'status' => 'Transfer'
                    ]);
                    $paid = PaymentReceipt::create([
                        'name' => $org->organization_name,
                        'payment_mode_id' => $request->payment_mode,
                        'admin_id' => auth()->user()->id,
                        'receipt_no' => generate_invoice_no(),
                        'total' => $org->registrationType->charge->amount,
                    ]);
                    Payment::create([
                        'payment_receipt_id' => $paid->id,
                        'service' => 'Payments for new ' . $org->registrationType->name . ' registration',
                        'amount' => $org->registrationType->charge->amount,

                        ]);
                    $org->payments()->save($paid);

                    break;
            }

        $notification = [
            'message' => 'Company account created',
            'alert' => 'success'
        ];
        return redirect()->route('company.index')->with($notification);
    }

    public function enrollStore(Request $request)
    {

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
            'organization_id' => 'sometimes',

        ]);


        if ($request->has('dob')) {
            $dob = strtotime($request->dob);

            $newDate = date('d-m-Y', $dob);
            $newDate = Carbon::parse($newDate);
            $validated['dob'] = $newDate;
        }
        $validated['source'] = 'company';


        if ($request->has('organization_id')) {
            $number = Organization::where('id', $request->organization_id)->first();
            $count = ($number->enrolment_count) ? $number->enrolment_count : 0;
            $getletter = num_to_letters(($count + 1));
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
        $number = Organization::where('id', $request->organization_id)->first();

        User::create($validated);

        $notification = [
            'message' => 'User added successfully',
            'alert' => 'success'
        ];
        return redirect()->route('company.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $company)
    {
        //
        return view('admin.patient.companyshow', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $company)
    {
        return view('admin.patient.companyedit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $company)
    {
        $data = $request->validate([

            'organisation_name' => 'required',
            'address' => 'nullable',
            'contact_phone' => 'nullable',
        ]);
        $company->update($data);
        $notification = [
            'message' => 'User added successfully',
            'alert' => 'success'
        ];
        return redirect()->route('company.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $company)
    {
        foreach ($company->users as $value) {
            $value->delete();
        }
        $company->delete();
        $notification = [
            'message' => 'company account deleted succesfully',
            'alert-type' => 'info'
        ];
        return back()->with($notification);
    }
}
