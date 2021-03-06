<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\PaymentMode;
use Illuminate\Http\Request;

class PaymentModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentmodes= PaymentMode::all();
        return view('admin.settings.paymentmode', compact('paymentmodes'));
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
        //
        $validated = $request->validate([
            'name' => 'required|unique:payment_modes|max:100',

        ]);

        PaymentMode::create($validated);
        $notification = array(
            'message' => 'payment modecreated successfully!',
            'alert-type' => 'success'
        );

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
    public function edit(PaymentMode $paymentmode)
    {
        //
        $paymentmodes = PaymentMode::all();
        $task = $paymentmode;
        return view('admin.settings.paymentmode', compact('task', 'paymentmodes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMode $paymentmode)
    {
        //

        $validated = $request->validate([
            'name' => 'required|max:100',

        ]);

        $paymentmode->update($validated);
        $notification = array(
            'message' => 'payment mode created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('paymentmode.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMode $paymentmode)
    {
        $paymentmode->delete();
        $notification = array(
            'message' => 'payment mode deleted successfully!',
            'alert-type' => 'danger'
        );

        return redirect()->route('paymentmode.index')->with($notification);

    }
}
