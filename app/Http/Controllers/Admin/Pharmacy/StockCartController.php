<?php

namespace App\Http\Controllers\Admin\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\DrugModel;
use App\Models\EmergencyCart;
use App\Models\NursingCart;
use App\Models\NursingCartRestock;
use App\Models\TheaterCart;
use Illuminate\Http\Request;

class StockCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $carts= NursingCartRestock::all()->sortByDesc('created_at');
       return view('admin.pharmacy.stockcart', compact('carts'));

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
    //    if ($request->supplier_id == 'emergency') {
    //        foreach ($request->drug_model_id as $key => $value) {
    //           $data = [
    //             'drug_model_id' => $request->drug_model_id[$key]
    //           ];
    //           EmergencyCart::create($data);
    //        }

    //        foreach ($request->drug_model_id as $key => $value){
    //            $found = EmergencyCart::where('drug_model_id', $request->drug_model_id[$key])->get();
    //            $found->emergencyCartBatches()->create([
    //                'brought_forward' => $found->available,

    //            ]);
    //        }
    //    }
        foreach ($request->drug_model_id as $key => $value) {
            $check = DrugModel::find($request->drug_model_id[$key]);
            if($check->available < $request->quantity[$key])
            {
                return back()->with([
                    'message' => $check->name . ' is not up to requested amount',
                    'type' =>'warning'
                ]);
            }
        }
        $restock = NursingCartRestock::create([
            'cart_type' => $request->supplier_id,
            'supplied_by' => auth()->user()->id,
            'costs' => $request->totalPurchase,
            'status' => 'supplied'
        ]);
        foreach ($request->drug_model_id as $key => $value) {
            $restock->cartRestockDetails()->create([
                'quantity_supplied' => $request->quantity[$key],
                'drug_model_id' => $request->drug_model_id[$key],
                'cost' => $request->linecost[$key],
                'unit' => $request->price[$key]
            ]);
        }
        $notification = [
            'message' => 'Cart Stock saved successfully',
            'type' => 'success'
        ];
        return redirect()->route('stockcart.index')->with($notification);
    }
    public function processStock(NursingCartRestock $id)
    {
        $details = $id->cartRestockDetails;
        $inserted = [];
        foreach ($details as $key => $value) {
           array_push($inserted, [
            'drugName' =>$value->drugModel->name,
            'drug_form'=> $value->drugModel->forms. '/'. $value->drugModel->strength,
            'cost' => $value->cost,
            'quantity' =>$value->quantity_supplied,
            'unit' => $value->unit
           ]);
        }
        $data = [
            'cartrestock' => $id,
            'stockdetails' => $inserted,
            'supplied_by' => $id->generatedBy->name,
            'received_by' => $id->suppliedBy->name ?? '',
        ];

        return response()->json($data);
    }
    public function recieveSupply(Request $request)
    {

        $recieve = NursingCartRestock::find($request->id);
        switch ($recieve->cart_type) {
            case 'emergency':
                foreach ($recieve->cartRestockDetails as $key => $value)
                {
                    $cart = EmergencyCart::where('drug_model_id', $value->drug_model_id)->first();
                    if(!(isset($cart))){
                        $cart = EmergencyCart::create([
                            'drug_model_id' => $value->drug_model_id,
                        ]);
                    }
                    $cart->emergencyCartBatches()->create([
                        'brought_forward'=> $cart->available,
                        'available_quantity' => $value->quantity_supplied,
                        'quantity_supplied' => $value->quantity_supplied,
                        'nursing_cart_restock_id' => $recieve->id
                    ]);
                    $remaining = $cart->drugModel->drugBatchDetails()->firstWhere('available_quantity', '>', (int) $value->quantity_supplied);

                    $remaining->decrement('available_quantity', (float) $value->quantity_supplied);
                }

                break;


            case 'theater':

                foreach ($recieve->cartRestockDetails as $key => $value)
                {
                    $cart = TheaterCart::where('drug_model_id', $value->drug_model_id)->first();
                    if(!(isset($cart))){
                        $cart = TheaterCart::create([
                            'drug_model_id' => $value->drug_model_id,
                        ]);
                    }
                    $cart->theaterCartBatches()->create([
                        'brought_forward'=> $cart->available,
                        'available_quantity' => $value->quantity_supplied,
                        'quantity_supplied' => $value->quantity_supplied,
                        'nursing_cart_restock_id' => $recieve->id
                    ]);
                    $remaining = $cart->drugModel->drugBatchDetails()->firstWhere('available_quantity', '>', (int) $value->quantity_supplied);

                    $remaining->decrement('available_quantity', (float) $value->quantity_supplied);
                }
                break;
        }
        $recieve->update([
            'status' => 'received',
            'recieved_by' => auth()->user()->id
        ]);
        $notification= [
            'message' => 'Received Supply from pharmacy',
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
