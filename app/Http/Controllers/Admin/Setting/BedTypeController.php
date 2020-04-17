<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\BedType;
use Illuminate\Http\Request;

class BedTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = BedType::all()->sortBy('name');
        return view('admin.ward.bedtype', compact('types'));
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
            'name' => 'required|unique:bed_types',
        ]);

        BedType::create($data);
        $notification = [
            'message' => 'Bedtype created successfully ',
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
    public function update(Request $request, BedType $bedtype)
    {
        $data = $request->validate([
            'name' => 'required|unique:bed_types',
        ]);

        $bedtype->update($data);
        $notification = [
            'message' => 'Bedtype updated successfully ',
            'alert-type' => 'success'
        ];
        return redirect()->route('bedtype.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BedType $bedtype)
    {
        $bedtype->delete();
        $notification = [
            'message' => 'Bedtype updated successfully ',
            'alert-type' => 'info'
        ];
        return redirect()->route('bedtype.index')->with($notification);
    }
}
