<?php

namespace App\Http\Controllers\Admin\Front;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\EnrollUser;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\RegistrationType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NhisPatientController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registration = RegistrationType::where('name', 'NHIS')->first();
        return view('admin.patient.nhiscreate', compact('registration'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // //
        // $percentCoverage = EnrollUser::where('id',$request->enroll_user_id )->first();
        // dd($request->except('_token'), split_charges($request->enroll_user_id));
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
            'insurance_number' => 'unique:users',
            'enroll_user_id' => 'required'

        ]);

        if ($request->has('dob')) {
            $dob = strtotime($request->dob);

            $newDate = date('d-m-Y', $dob);
            $newDate = Carbon::parse($newDate);
            $validated['dob'] = $newDate;
        }
        $validated['source'] ='nhis';

        $validated['folder_number'] = assign_Fno( $request->registration_type_id);


        if ($request->has('avatar')) {
            //
            $image = $request->avatar; // your base64 encoded

            // $image = str_replace('data:image/png;base64,', '', $image);

            // $image = str_replace(' ', '+', $image);
            @list($type, $file_data) = explode(';', $image);
            @list(, $file_data) = explode(',', $file_data);
            $storage_path = public_path() . '/backend/images/avatar';
            $imageName = $request->last_name . $request->other_names . Date('Y-m-d') . '.' . 'png';
            $validated['avatar'] = $imageName;
            \File::put($storage_path . '/' . $imageName, base64_decode($file_data));
        }
        $validated['registered_by'] = Auth::user()->id;

        $validated['password'] = Hash::make('pentacare');

        $new = User::create($validated);


        $charge = Charge::select('amount')->where('name', 'Individual')->first();
        $percentCoverage = split_charges($new->enroll_user_id);
        if($new->enrollUser->insurancePackage->percentage < 100)
        {
            $invoice= Invoice::create([
                'user_id' => $new->id,
                'invoice_no' => generate_invoice_no(),
                'amount' => number_format($charge->amount * $percentCoverage['patient_pays']/100, 2, '.', '') ,
                'admin_id' => auth()->user()->id,
                'p_status' => 'NYP',
                'status' => 'Registration',
            ]);

            $new->enrollUser->insurancePackage->invoice()->save($invoice);

            $invoice->invoiceItems()->create([
                'item_description' => 'New Registration Charge '.$percentCoverage['patient_pays'].'% patient-charge',
                'amount' => number_format($charge->amount * $percentCoverage['patient_pays']/100, 2, '.', '') ,
                'status' => 'NYP'
            ]);
        }

        $new->enrollUser->enrollCharges()->create([
            'service' => 'New Registration Charge '.$percentCoverage['coverage'].'% insurance-charge',
            'charge' => $charge->amount,
            'patient_paid' => (isset($percentCoverage['patient_pays'])? number_format($charge->amount * $percentCoverage['patient_pays']/100, 2, '.', ''): 0 ),
            'insurance_cover' => number_format($charge->amount * $percentCoverage['coverage']/100, 2, '.', ''),
            'payment_status' => 'NYP'
        ]);




        $new->enrollUser->update([
            'status'   =>   'registered'
        ]);


        $notification = array(
            'message' => 'Patient created successfully!',
            'alert-type' => 'success',
        );

        return redirect('admin/patient')->with($notification);
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
