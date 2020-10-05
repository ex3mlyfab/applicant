<?php

namespace App\Http\Controllers\Admin\Front;

use App\Http\Controllers\Controller;
use App\Models\Allergy;
use App\Models\BankTransfer;
use App\Models\Charge;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\MdAccount;
use App\Models\Payment;
use App\Models\PaymentMode;
use App\Models\RegistrationType;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = User::all();
        $charge = Charge::where('name', 'Consultation')->first();
        return view('admin.patient.index', compact('patients','charge'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $individual = RegistrationType::where('name', 'Individual')->orWhere('name', 'Student')->orWhere('name', 'Ante-Natal')->get();
        $paymentmode = PaymentMode::all();
        return view('admin.patient.create', compact('individual', 'paymentmode'));
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

        ]);

        if ($request->has('dob')) {
            $dob = strtotime($request->dob);

            $newDate = date('d-m-Y', $dob);
            $newDate = Carbon::parse($newDate);
            $validated['dob'] = $newDate;
        }

        $individualAccounts = RegistrationType::where('max_enrollment', 1)->get();
        foreach ($individualAccounts as $key => $value) {

            if ($request->registration_type_id == $value->id) {

                $validated['source'] = $value->name;
            }

        }

        // switch ($request->registration_type_id) {
        //     case 'Ante-Natal':
        //         $validated['source'] = 'antenatal';
        //         break;
        //     case 'student':
        //         $validated['source'] = 'student';
        //         break;
        //     default:
        //         $validated['source'] = 'individual';
        //         break;
        // }

        $validated['folder_number'] = assign_Fno($validated['source']);


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
        switch ($request->payment_mode) {
            case 2:
                BankTransfer::create([
                    'bank_id' => $request->transfer_id,
                    'user_id' => $new->id,
                    'amount_transfered' => $new->registrationType->charge->amount,
                    'status' => 'POS'
                ]);
                Payment::create([
                    'payment_mode_id' => $request->payment_mode,
                    'user_id' => $new->id,
                    'admin_id' => Auth::user()->id,
                    'service' => 'Payments for new ' . $new->source . ' registration',
                    'amount' => $new->registrationType->charge->amount,
                    'invoice_no' => generate_invoice_no(),
                    ]);
                break;
            case 1:
                Payment::create([
                'payment_mode_id' => $request->payment_mode,
                'user_id' => $new->id,
                'admin_id' => Auth::user()->id,
                'service' => 'Payments for new ' . $new->source . ' registration',
                'amount' => $new->registrationType->charge->amount,
                'invoice_no' => generate_invoice_no(),
                ]);
                break;
            case 3:
                BankTransfer::create([
                    'bank_id' => $request->transfer_id,
                    'user_id' => $new->id,
                    'amount_transfered' => $new->registrationType->charge->amount,
                    'status' => 'Transfer'
                ]);
                Payment::create([
                    'payment_mode_id' => $request->payment_mode,
                    'user_id' => $new->id,
                    'admin_id' => Auth::user()->id,
                    'service' => 'Payments for new ' . $new->source . ' registration',
                    'amount' => $new->registrationType->charge->amount,
                    'invoice_no' => generate_invoice_no(),
                    ]);
                break;
            case 4 :
                $invoice= Invoice::create([
                    'user_id' => $new->id,
                    'invoice_no' => generate_invoice_no(),
                    'amount' => $new->registrationType->charge->amount,
                    'admin_id' => auth()->user()->id,
                    'p_status' => 'MD account',
                ]);
                $newta = array(
                    'invoice_id' => $invoice->id,
                    'item_description' => 'New Individual Patient Account Registration',
                    'amount' => $new->registrationType->charge->amount ,
                    'status' =>'MD Account',
                );
                InvoiceItem::create($newta);
                $mdaccount = MdAccount::create([
                    'user_id' =>$new->id
                ]);
                $mdaccount->invoice()->save($invoice);
                break;
            case 5 :
                $new->retainership()->create([
                    'credit' => $new->registrationType->charge->amount,
                    'comment' => 'New registration charge',
                    'balance' => number_format($new->retainership_balance - $new->registrationType->charge->amount,2, '.', ''),
                ]);
                break;
            default:
                # code...
                break;
        }



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
    public function show(User $patient)
    {

        return view('admin.patient.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $patient)
    {
        return view('admin.patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $patient)
    {
        //
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
            if($patient->avatar){
                \File::delete($storage_path . '/' . $patient->avatar);
            }
            \File::put($storage_path . '/' . $imageName, base64_decode($file_data));
        }

        $patient->update($validated);

        $notification = array(
            'message' => 'Patient created successfully!',
            'alert-type' => 'success',
        );

        return redirect('admin/patient')->with($notification);
    }
    public function patientAjax($id)
    {
        $user = User::where('id', $id)->get();

        return json_encode($user);
    }
    public function addAllergy(Request $request)
    {
        //
        Allergy::create($request->validate([

        ]));
        $notification = [
            'message' => 'allergy added successfully',
            'type' => 'success'
        ];
        return back()->with($notification);
    }
    public function removeAllergy(Allergy $allergy)
    {
        $allergy->delete();
        $notification = [
            'message' => 'allergy deleted successfully',
            'type' => 'danger',
        ];
        return back()->with($notification);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $patient)
    {
        //
        $storage_path = public_path() . '/backend/images/avatar';
        if($patient->avatar){
            \File::delete($storage_path . '/' . $patient->avatar);
        }
        $patient->delete();
        $notification = array(
            'message' => 'Patient deleted successfully!',
            'alert-type' => 'info',
        );

        return redirect('admin/patient')->with($notification);
    }
    public function assignFNo()
    {

        $year = Carbon::now()->year;
        $users = new User();
        $count = $users->whereYear('created_at', '=', $year)
            ->count();
        $count += 1;
        $formatted_value = sprintf("%04d", $count);

        return $formatted_value . "/" . $year;
    }
}
