<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\ChargeCategory;
use Illuminate\Http\Request;

class ChargeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ChargeCategory::all();
        return view('admin.account.category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:charge_categories|max:100',
            'description' => 'nullable|string',
        ]);

        ChargeCategory::create($validated);
        $notification = array(
            'message' => 'Charge Category created successfully!',
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
    public function edit(ChargeCategory $chargecategory)
    {
        $categories = ChargeCategory::all();
        $task = $chargecategory;
        return view('admin.account.category', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChargeCategory $chargecategory)
    {
        $validated = $request->validate([
            'name' => 'required|unique:charge_categories|max:100',
            'description' => 'nullable|string',
        ]);

        $chargecategory->update($validated);
        $notification = array(
            'message' => 'Charge Category created successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('chargecategory.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChargeCategory $chargecategory)
    {
        $chargecategory->charges()->delete();
        $chargecategory->delete();
        $notification = array(
            'message' => 'Charge Category deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('chargecategory.index')->with($notification);

    }
}
