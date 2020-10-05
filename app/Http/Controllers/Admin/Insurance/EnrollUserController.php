<?php

namespace App\Http\Controllers\Admin\Insurance;

use App\Http\Controllers\Controller;
use App\Models\ActiveEnrollment;
use App\Models\EnrollUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EnrollUserController extends Controller
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
        //
    }
    public function getByInsurance($id)
    {
        $insured = User::where('insurance_number', $id)->with('enrollUser')->get();
        if($insured)
        {
            return json_encode($insured);
        }else{
            return json_encode(['message'=> 'not yet registered']);
        }
    }
    public function getInsuredPatient($id)
    {
        $confirm = EnrollUser::where('insurance_no', $id)->get();
        if($confirm)
        {
            return json_encode($confirm);
        }else{
            return json_encode(['message'=> 'not yet registered']);
        }
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
        if($request->has('user_id'))
        {
            $data = User::findorFail($request->user_id);

        }else{
            $request->validate([
                'insurance_no' =>'unique:enroll_users'
            ]);
            $data = EnrollUser::create([
                'insurance_no' => $request->insurance_no,
                'insurance_packages_id' => $request->insurance_id,
                'last_name' => $request->last_name,
                'other_names' => $request->other_names
            ]);
        }

        if($request->confirm_enrollment){
            ActiveEnrollment::create([
                'enroll_user_id' => $data->id,
                'months' => date('M'),
                'year' =>now(),
            ]);
            $data->update([
                'is_active' => true
            ]);
        }
        $notification = [
            'message' => 'user enrolled successfully',
            'type' => 'success'
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
