<?php

namespace App\Http\Controllers\Admin\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\DrugBatchDetail;
use App\Models\DrugModel;
use App\Models\PurchaseOrder;
use App\Models\RecieveOrder;
use App\Models\RecieveOrderDetail;
use App\Models\SupplierPayable;
use App\Models\SupplierPurchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecieveOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recieve = RecieveOrder::all();
        $approved = PurchaseOrder::where('status', 'approved')->get();
        return view('admin.pharmacy.recievedOrder', compact('recieve', 'approved'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOne(Request $request)
    {
        $recieveOrder = PurchaseOrder::find($request->id);
        return view('admin.pharmacy.recievepurchase', compact('recieveOrder'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //store recieve order
        $recieve = RecieveOrder::create([
            'purchase_order_id' => $request->purchase_order_id,
            'status' => 'recieved',
            'supplier_id' => $request->supplier_id,
            'costs' => $request->cost,
            'receipt_no' => $request->receipt_no,
            'payment_status' => $request->payment_mode,
            'checked_by' => Auth::user()->id,

        ]);
        // store recieve order details
        // store drug batch details

        foreach($request->drug_model_id as $key => $value){
            $data =array(
                'receive_order_id' => $recieve->id,
                'drug_model_id' => $request->drug_model_id[$key],
                'quantity_needed' => $request->quantity_needed[$key],
                'price' => $request->price[$key],
            );
            $juice = RecieveOrderDetail::create($data);

            $dugdata = array(
                'drug_model_id' => $request->drug_model_id[$key],
                'quantity_supplied' => $request->quantity_needed[$key],
                'expiry_date' => Carbon::parse(strtotime($request->expiry_date[$key])),
                'cost' => $request->selling_price[$key],
                'supplier_id' => $request->supplier_id,
                'purchase_price' => $request->price[$key],
                'purchase_date' => Carbon::parse(strtotime($request->purchase_date)),
                'recieve_order_id' => $request->supplier_id,
                'packing_quantity' => $juice->drugModel->available,
                'available_quantity' => $request->quantity_needed[$key],

            );
             DrugBatchDetail::create($dugdata);


        }

        //update supplier payments info
        switch ($request->payment_mode) {
            case 'credit':
                SupplierPayable::create([
                    'supplier_id' => $request->supplier_id,
                    'received_order_id' => $recieve->id,
                    'details' => 'recieved supply on'.' '.$request->purchase_date,
                    'amount_to_be_paid' => $request->cost,
                ]);
                break;
            case 'debit':
                SupplierPurchase::create([
                    'supplier_id' => $request->supplier_id,
                    'received_order_id' => $recieve->id,
                    'details' => 'recieved supply on'.' '.$request->purchase_date,
                    'amount_paid' => $request->cost,

                ]);
             break;


        }
        //update status  on purchase
        $recieve->purchaseOrder()->update([
                'status' => 'completed',
        ]);
        $notification =[
            'message' => 'Order received successfully',
            'type' => 'success'
        ];

        return redirect()->route('recieveorder.index')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(RecieveOrder $recieveorder)
    {
        //
        return view('admin.pharmacy.recieveorderdetails', compact('recieveorder'));
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
