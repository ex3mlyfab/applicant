<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\Bed;
use App\Models\WardModel;
use Illuminate\Http\Request;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beds = Bed::all()->sortBy('ward_model_id');
        return view('admin.ward.bed', compact('beds'));
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
            'bed_type_id' => 'required',
            'ward_model_id' => 'required',
            'status' => 'nullable',
        ]);
        $pool = WardModel::find($data['ward_model_id']);
        $allocated = Bed::where('ward_model_id', $data['ward_model_id'])->count();
        if ($allocated >= $pool->max_no_of_bed) {

            $notification = [
                'message' => $pool->name . ' filled, try another ward',
                'alert-type' => 'success'
            ];
            return back()->with($notification);
        } else {
            Bed::create($data);
            $notification = [
                'message' => 'Bed Record created successfully',
                'alert-type' => 'success'
            ];
            return back()->with($notification);
        }
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
    public function update(Request $request, Bed $bed)
    {
        //
        $data = $request->validate([
            'bed_type_id' => 'required',
            'ward_model_id' => 'required',
            'status' => 'nullable',
        ]);
        $bed->update($data);
        $notification = [
            'message' => 'Bed Record updated successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('bed.index')->with($notification);
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
