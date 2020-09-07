<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Supplier as ModelsSupplier;
use Illuminate\Http\Request;

class Supplier extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $supplier = ModelsSupplier::all();
        return view('admin.Account.supplier', compact('supplier'));
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
            'name' => 'required|string',
            'contact_phone' => 'required',
            'contact_person_name' => 'sometimes',
            'insurance_category_id' => 'required',
            'address' => 'sometimes',
        ]);

        ModelsSupplier::create($validated);
        $notification = array(
            'message' => 'Supplier added created successfully!',
            'alert-type' => 'success',
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
    public function update(Request $request, ModelsSupplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'contact_phone' => 'required',
            'contact_person_name' => 'sometimes',
            'insurance_category_id' => 'required',
            'address' => 'sometimes',
        ]);

        $supplier->update($validated);
        $notification = array(
            'message' => 'Supplier Details updated successfully!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsSupplier $supplier)
    {
        $supplier->delete();
        $notification = array(
            'message' => 'Supplier Details deleted successfully!',
            'alert-type' => 'danger',
        );

        return back()->with($notification);

    }
}
