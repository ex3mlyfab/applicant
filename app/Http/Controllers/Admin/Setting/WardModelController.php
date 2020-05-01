<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\WardModel;
use Illuminate\Http\Request;

class WardModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wards = WardModel::all()->sortBy('floor_id');
        return view('admin.ward.ward', compact('wards'));
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
            'name' => 'required|unique:ward_models',
            'description' => 'nullable',
            'floor_id' => 'required',
            'max_no_of_bed' => 'required'
        ]);
        WardModel::create($data);
        $notification = [
            'message' => 'ward model created succesfully',
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
    public function update(Request $request, WardModel $ward)
    {
        //
        $data = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'floor_id' => 'required',
            'max_no_of_bed' => 'required'
        ]);

        $ward->update($data);
        $notification = [
            'message' => 'ward model updated succesfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('ward.index')->with($notification);
    }
    public function wardmodelajax(WardModel $ward)
    {
        $real = $ward->beds->filter(function ($value, $key) {
            return $value->status == "";
        });
        $real = $real->pluck("id");
        return json_encode($real);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(WardModel $ward)
    {
        $ward->delete();
        $notification = [
            'message' => 'ward model deleted succesfully',
            'alert-type' => 'info'
        ];
        return redirect()->route('ward.index')->with($notification);
    }
}
