<?php

namespace App\Http\Controllers\Admin\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\DrugClass;
use Illuminate\Http\Request;

class DrugClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugcategories = DrugClass::all();
        return View('admin.pharmacy.drugcategories', compact('drugcategories'));
    }

    public function ClassAjax()
    {
        $sections = DrugClass::all()->pluck("name", "id");
        return json_encode($sections);
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
            'name' => 'required|unique:drug_categories'
        ]);
        DrugClass::create($data);
        $notification = [
            'message' => 'drug Class created successfully',
            'alert-type' => 'success'
        ];
        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DrugClass $drugClass)
    {
        return view('admin.pharmacy.drugsubcategories', compact('drugClass'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DrugClass $drugClass)
    {
        //
        $task = $drugClass;
        $drugcategories = DrugClass::all();
        return View('admin.pharmacy.drugcategories', compact('drugcategories', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DrugClass $drugClass)
    {
        //
        $data = $request->validate([
            'name' => 'required'
        ]);
        $drugClass->update($data);
        $notification = [
            'message' => 'drug Class created successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('drugClass.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrugClass $drugClass)
    {
        $drugClass->delete();
        $notification = [
            'message' => 'drug Class created successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('drugClass.index')->with($notification);
    }
}
