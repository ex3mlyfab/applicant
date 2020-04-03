<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\AssetAssign;
use App\Models\AssetModel;
use App\Models\AssetPurchase;
use Illuminate\Http\Request;

class AssetAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aseetsassigned = AssetAssign::all()->sortByDesc('created_at');
        return view('admin.asset.assetassignment', compact('assetassigned'));
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
        $data = $request->validate([
            'asset_model_id' => 'required',
            'assigned_to' => 'required|string',
            'quantity_assigned' => 'required',
            'check_in_date' => 'nullable',
            'date_assigned' => 'nullable',
        ]);
        $adjust = 0;
        $adjustasset = AssetPurchase::where('asset_model_id', $request->asset_model_id)->where('balance', '!=', 0)->first();
        if ($request->quantity_assigned > $adjustasset->assetModel->total_balance) {
            $notification = [
                'message' => 'Adjust Assigning quantity as it is greater than total',
                'alert-type' => 'info'
            ];
            return back()->with($notification);
        } else if ($request->quantity_assigned > $adjustasset->balance) {
            $adjust = $adjustasset->balance - $request->quantity_assigned;
            $adjustasset->update([
                'balance' => 0,
            ]);
            $adjustasset2 = AssetPurchase::where('asset_model_id', $request->asset_model_id)->where('balance', '!=', 0)->first();
            $adjust = $adjustasset2->balance + $adjust;
            $adjustasset2->update([
                'balance' => $adjust,

            ]);
        } else {
            $adjust = $adjustasset->balance - $request->quantity_assigned;
            $adjustasset->update([
                'balance' => $adjust,
            ]);
        }
        AssetAssign::create($data);


        $notification = [
            'message' => 'Asset assigned succesfully',
            'alert-type' => 'info'
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
    public function update(Request $request, $id)
    {
        //
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
