<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\InsuranceCategory as ModelsInsuranceCategory;
use Illuminate\Http\Request;

class InsuranceCategory extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ModelsInsuranceCategory::all();
        return view('admin.settings.insuranceCategory', compact('categories'));
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
        ModelsInsuranceCategory::create($request->validate([
            'name' => 'required|unique:insurance_categories',
            'description' => 'sometimes',
        ]));
        $notification = [
            'message' => 'Insurance Category created successfully',
            'alert-type' => 'success',
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
    public function update(Request $request, ModelsInsuranceCategory $insuranceCategory)
    {
        //
        $insuranceCategory->update($request->validate([
            'name' => 'required',
            'description' => 'sometimes'
        ]));
        $notification = [
            'message' => 'Insurance Category updated successfully',
            'alert-type' => 'success',
        ];
        return back()->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsInsuranceCategory $insuranceCategory)
    {
        //
        $insuranceCategory->delete();

        $notification = [
            'message' => 'Insurance Category deleted successfully',
            'alert-type' => 'success',
        ];
        return back()->with($notification);

    }
}
