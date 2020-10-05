<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\MdAccount;
use App\Models\MdAccountCover;
use App\Models\User;
use Illuminate\Http\Request;

class MdAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = User::all();
        $mdaccounts = MdAccount::all()->sortByDesc('created_at');
         return  view('admin.settings.mdaccounts', compact('mdaccounts', 'patients'));
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
        // dd($request->except('_token'));

        $account = MdAccount::create([
            'user_id' => $request->user_id
        ]);

        foreach ($request->service_types as $key => $value) {
            $data = array(
                'md_account_id' => $account->id,
                'name' => $request->service_types[$key],
                'percentage' => $request->percentage,
                'admin_id' => auth()->user()->id
            );
            MdAccountCover::create($data);
        }
        $notification=[
            'message' =>'beneficiary added successfully',
            'type' => 'success '
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
    public function update(Request $request,MdAccount $mdaccount)
    {
        $mdaccount->mdAccountCovers()->delete();


        foreach ($request->service_types as $key => $value) {
            $data = array(
                'md_account_id' => $mdaccount->id,
                'name' => $request->service_types[$key],
                'percentage' => $request->percentage,
                'admin_id' => auth()->user()->id
            );
            MdAccountCover::create($data);
        }
        $notification = [
            'message' => 'Beneficiary updated  successfully',
            'type' => 'danger'
        ];
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MdAccount $mdaccount)
    {
        $mdaccount->mdAccountCovers()->delete();
        $mdaccount->delete();
        $notification = [
            'message' => 'Beneficiary removed successfully',
            'type' => 'danger'
        ];
        return back()->with($notification);
    }
}
