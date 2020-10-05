<?php

namespace App\Http\Controllers\Admin\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder as ModelsPurchaseOrder;
use App\Models\PurchaseOrderDetail;
use Illuminate\Http\Request;

class PurchaseOrder extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrder = ModelsPurchaseOrder::all();

        return view('admin.pharmacy.purchaseOrder', compact('purchaseOrder'));
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
        $new = ModelsPurchaseOrder::create([
            'generated_by' => auth()->user()->id,
            'supplier_id'  => $request->supplier_id,
            'total' => $request->totalPurchase,
            'status' => 'awaiting approval',
        ]);

        foreach ($request->drug_model_id as $key => $medicine_id) {
            $data = array(
                'purchase_order_id' =>$new->id,
                'drug_model_id' => $request->drug_model_id[$key],
                'price' => $request->price[$key],
              'quantity_needed'  => $request->quantity[$key],


            );

            PurchaseOrderDetail::insert($data);

        }
       $notification = [
           'message' => 'Purchase Order generated succesfully',
           'type' => 'success'
       ];
       return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ModelsPurchaseOrder $purchaseOrder)
    {
        return view('admin.pharmacy.purchasepreview', compact('purchaseOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelsPurchaseOrder $purchaseOrder)
    {
        return view('admin.pharmacy.purchaseorderdetails', compact('purchaseOrder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,ModelsPurchaseOrder $purchaseOrder)
    {
        //

        $confirmed=[];
        $details = $purchaseOrder->purchaseOrderDetails()->pluck('id');
        $approved = $request->approved;
        foreach ($request->purchase_order_detail_id as $key => $value) {
            if(in_array($request->purchase_order_detail_id[$key], $approved)){
                array_push($confirmed, $request->purchase_order_detail_id[$key]);
            }

         }
         $diiference = array_diff($details->toarray(), $confirmed);
        // dd($details->toArray(), $approved, $confirmed, $diiference);
        if((sizeof($diiference))){
            foreach( $diiference as $key=> $value){
                $del = PurchaseOrderDetail::find($diiference[$key]);
                $del->delete();
            }
        }
       $purchaseOrder->update([
           'status' => 'approved',
           'time_approved' => now(),
           'approved_by' => auth()->user()->id,
       ]);
       $notification = [
           'message' => 'Approval granted succesfully',
           'type' => 'success'
       ];
       return redirect()->route('purchaseOrder.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsPurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->purchaseOrderDetails()->delete();
        $purchaseOrder->delete();
        $notification = [
            'message' => 'deleted successfully',
            'type' => 'warning'
        ];
        return back()->with($notification);
    }
}
