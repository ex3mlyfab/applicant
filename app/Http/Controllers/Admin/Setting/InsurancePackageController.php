<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\InsurancePackage;
use App\Models\InsuranceService;
use Illuminate\Http\Request;

class InsurancePackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $package = InsurancePackage::create([
            'name' => $request->name,
            'insurance_id' => $request->insurance_id,
            'percentage' => $request->percentage,
            'note' =>$request->note
        ]);
        foreach ($request->service_types as $key => $value) {
            $data = array(
                'insurance_package_id' => $package->id,
                'service_type' => $request->service_types[$key],
            );

            InsuranceService::create($data);
        }
        $notification = [
            'message' => 'package added successfuly',
            'type' => 'success'
        ];
        return redirect()->route('insurance.show', $package->insurance->id)->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(InsurancePackage $insurancepackage)
    {
        // dd($insurancepackage);
        return view('admin.settings.insuranceenroll', compact('insurancepackage'));
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
    public function update(Request $request, InsurancePackage $insurancepackage)
    {
        //
        // dd($request->except('_token'), $insurancepackage);

        $insurancepackage->insuranceServices()->delete();
        $insurancepackage->update([
            'name' => $request->name,
            'percentage' => $request->percentage,
            'note' =>$request->note
        ]);
        foreach ($request->service_types as $key => $value) {
            $data = array(
                'insurance_package_id' => $insurancepackage->id,
                'service_type' => $request->service_types[$key],
            );
            InsuranceService::create($data);
        }

        $notification = [
            'message' => 'package added successfuly',
            'type' => 'success'
        ];
        return back()->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(InsurancePackage $insurancepackage)
    {
        //
        $insurancepackage->insuranceServices()->delete();
        $insurancepackage->delete();
        $notification = [
            'message' => 'package deleted successfuly',
            'type' => 'danger'
        ];
        return back()->with($notification);


    }
}
