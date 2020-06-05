<?php

namespace App\Http\Controllers\Admin\Front;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Models\Payment;
use App\Models\RegistrationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        return view('admin.patient.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $individual = RegistrationType::where('name', 'Individual')->orWhere('name', 'Student')->orWhere('name', 'Ante-Natal')->get();

        return view('admin.patient.create', compact('individual'));
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
            'national_id' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'age_at_reg' => 'nullable|string',
            'marital_status' => 'nullable|string',
            'registration_type_id' => 'nullable',
            'occupation' => 'nullable',
            // 'tribe'=> 'nullable',

        ]);


        if ($request->has('dob')) {
            $dob = strtotime($request->dob);
            $newDate = date('Y-m-d', $dob);
            $validated['dob'] = $newDate;
        }
        switch ($request->registration_type_id) {
            case 15:
                $validated['source'] = 'antenatal';
                break;
            case 12:
                $validated['source'] = 'student';
                break;
            default:
                $validated['source'] = 'individual';
                break;
        }



        $validated['folder_number'] = assign_Fno($validated['source']);



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
        $validated['registered_by'] = Auth::user()->id;

        $validated['password'] = Hash::make('pentacare');
        // dd($validated);

        $new = User::create($validated);
        Payment::create([
            'payment_mode_id' => 1,
            'user_id' => $new->id,
            'admin_id' => Auth::user()->id,
            'service' => 'Payments for new ' . $new->source . ' registration',
            'amount' => $new->registrationType->charge->amount,
            'invoice_no' => generate_invoice_no(),
        ]);

        $notification = array(
            'message' => 'Patient created successfully!',
            'alert-type' => 'success'
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
            'phone' => 'required|string|max:255',
            'sex' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'nok' => 'nullable|string|max:255',
            'nok_phone' => 'nullable|string|max:255',
            'nok_relationship' => 'nullable|string|max:255',
            'nok_address' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'nullable|string',
            'national_id' => 'nullable|string',
            'state' => 'nullable|string',
            'city' => 'nullable|string',
            'age_at_reg' => 'nullable|string',
            'marital_status' => 'nullable|string',

        ]);
        if ($request->has('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        if ($request->has('dob')) {
            $dob = strtotime($request->dob);
            $newDate = date('Y-m-d', $dob);
            $validated['dob'] = $newDate;
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

        $patient->update($validated);


        $notification = array(
            'message' => 'Patient created successfully!',
            'alert-type' => 'success'
        );

        return redirect('admin/patient')->with($notification);
    }
    public function patientAjax($id)
    {
        $user = User::select('avatar', 'sex', 'folder_number', 'phone')->where('id', $id)->get();

        return json_encode($user);
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
        $patient->delete();
        $notification = array(
            'message' => 'Patient deleted successfully!',
            'alert-type' => 'info'
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
