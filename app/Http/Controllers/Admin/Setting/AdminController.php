<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::all();
        return view('admin.user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
        $data = $request->validate([
            'name' => 'required',
            'other_names' => 'required',
            'email' => 'nullable',
            'phone' => 'required',
            'address' => 'nullable',
            'p_address' => 'nullable',
            'gender' => 'nullable',
            'marital_status' => 'required',

        ]);
        if ($request->has('dob')) {
            $dob = strtotime($request->dob);
            $newDate = date('Y-m-d', $dob);
            $data['dob'] = $newDate;
        }
        if ($request->has('date_of_joining')) {
            $date_of_joining = strtotime($request->date_of_joining);
            $newDate = date('Y-m-d', $date_of_joining);
            $data['date_of_joining'] = $newDate;
        }

        $data['password'] = Hash::make('admin.pentacare');

        if ($request->hasFile('resume')) {
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
            $file = $request->resume;

            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $storage_path = public_path() . '/backend/images/documents';
                $fileName = $request->last_name . $request->other_names . Date('Y-m-d') . 'resume' . '.' . $extension;
                $file->move($storage_path, $fileName);
                $data['resume'] = $fileName;
            }
        }
        if ($request->hasFile('acceptance_letter')) {
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
            $file = $request->acceptance_letter;

            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $storage_path = public_path() . '/backend/images/documents';
                $fileName = $request->last_name . $request->other_names . Date('Y-m-d') . 'acceptance_letter' . '.' . $extension;
                $file->move($storage_path, $fileName);
                $data['acceptance_letter'] = $fileName;
            }
        }
        if ($request->hasFile('application_letter')) {
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
            $file = $request->application_letter;

            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $storage_path = public_path() . '/backend/images/documents';
                $fileName = $request->last_name . $request->other_names . Date('Y-m-d') . 'application_letter' . '.' . $extension;
                $file->move($storage_path, $fileName);
                $data['application_letter'] = $fileName;
            }
        }
        if ($request->hasFile('appointment_letter')) {
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
            $file = $request->appointment_letter;

            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $storage_path = public_path() . '/backend/images/documents';
                $fileName = $request->last_name . $request->other_names . Date('Y-m-d') . 'appointment_letter' . '.' . $extension;
                $file->move($storage_path, $fileName);
                $data['appointment_letter'] = $fileName;
            }
        }
        if ($request->hasFile('avatar')) {
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
            $file = $request->avatar;

            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $storage_path = public_path() . '/backend/images/documents';
                $fileName = $request->last_name . $request->other_names . Date('Y-m-d') . 'avatar' . '.' . $extension;
                $file->move($storage_path, $fileName);
                $data['avatar'] = $fileName;
            }
        }

        $admin = Admin::create($data);

        $admin->assignRole($request->role_id);

        $notification = [
            'message' => 'Admin User created successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('user.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $user)
    {
        $admin = $user;
        return view('admin.user.profile', compact('admin'));
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
    public function changePassword(Request $request, Admin $user)
    {
        $data = $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|string',
            'password_confirm' => 'required|min:8|string',
        ]);
        if ($request->password === ($request->password_confirm)) {
            if (Hash::check($request->current_password, $user->password)) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
                $notification = [
                    'message' => ' password  changed succesfully',
                    'alert-type' => 'success'
                ];
                return back()->with($notification);
            } else {
                $notification = [
                    'message' => 'current password  is not correct',
                    'alert-type' => 'info'
                ];
                return back()->with($notification);
            }
        } else {
            $notification = [
                'message' => 'password does not match',
                'alert-type' => 'info'
            ];
            return back()->with($notification);
        }
    }

    public function avatar(Request $request, Admin $user)
    {

        $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
        $file = $request->file;

        $extension = $file->getClientOriginalExtension();
        $check = in_array($extension, $allowedfileExtension);
        if ($check) {
            $storage_path = public_path() . '/backend/images/documents';
            $fileName = $user->last_name . $user->other_names . Date('Y-m-d') . 'avatar' . '.' . $extension;
            if (isset($user->avatar)) {
                \File::delete($storage_path . '/' . $user->avatar);
            }
            $file->move($storage_path, $fileName);
            $user->update([
                'avatar' => $fileName,
            ]);
        }
        $notification = [
            'message' => 'picture uploaded successfully',
            'alert-type' => 'success'
        ];
        return back()->with($notification);
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
