<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\AssetAssign;
use App\Models\AssetModel;
use App\Models\AssetPurchase;
use Illuminate\Http\Request;

class AssetPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $assetpurschased = AssetPurchase::all()->sortByDesc('created_at');
        return view('admin.asset.assetpurchase', compact('assetpurchased'));
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
            'vendor' => 'nullable',
            'quantity' => 'required',
            'purchase_price' => 'nullable',
            'purchase_date' => 'nullable',
            'expiry_date' => 'nullable',
            'purchased_by' => 'nullable',
        ]);
        $data['balance'] = $request->quantity;


        $parent = AssetModel::find($request->asset_model_id);
        if ($parent->total_balance) {
            $total = $parent->total_balance + $request->quantity;
            $parent->update([
                'total_balance' => $total,
            ]);
        } else {
            $parent->update([
                'total_balance' =>  $request->quantity,
            ]);
        }

        $notification = [
            'message' => 'purchase recorded successfully',
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
    public function update(Request $request, AssetAssign $assetassign)
    {
        //
        $data = $request->validate([
            'asset_model_id' => 'required',
            'vendor' => 'nullable',
            'quantity' => 'required',
            'purchase_price' => 'nullable',
            'purchase_date' => 'nullable',
            'expiry_date' => 'nullable',
            'purchased_by' => 'nullable',
        ]);

        $assetassign->update($data);
        $notification = [
            'message' => 'purchase recorded successfully',
            'alert-type' => 'success'
        ];

        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetAssign $assetassign)
    {
        //
        $assetassign->delete();
        $notification = [
            'message' => 'purchase deleted successfully',
            'alert-type' => 'info'
        ];

        return back()->with($notification);
    }
}
