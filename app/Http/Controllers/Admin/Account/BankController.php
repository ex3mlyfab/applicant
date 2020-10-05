<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banks = Bank::all();
        return view('admin.account.bank', compact('banks'));
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
        $data = $request->validate([
            'name' => 'required',
            'account_name'=> 'required',
            'account_number' => 'required|unique:banks',
        ]);

        Bank::create($data);
        $notification = [
            'message' => 'Bank created successfully',
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
    public function show(Bank $bank)
    {
        //
        return view('admin.Account.banktransfer', compact('bank'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        //
        $task = $bank;
        $banks = Bank::all();
        return view('admin.account.bank', compact('banks', 'task'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Bank $bank)
    {
        //
        $bank->update($request->validate([
            'name' => 'required',
            'account_name'=> 'required',
            'account_number' => 'required'
        ]));
        $notification = [
            'message' => 'Bank details updated successfully',
            'type' => 'success'
        ];

        return redirect()->route('bank.index')->with($notification);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        //
        $bank->delete();
        $notification = [
            'message' => 'Bank deleted successfully',
            'type' => 'danger'
        ];

        return back()->with($notification);

    }
}
