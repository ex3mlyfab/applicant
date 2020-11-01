<?php

namespace App\Http\Controllers\Admin\Account;

use App\Http\Controllers\Controller;
use App\Models\Supplier as ModelsSupplier;
use App\Models\SupplierPayable;
use App\Models\SupplierPurchase;
use Illuminate\Http\Request;

class Supplier extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $supplier = ModelsSupplier::all();
        return view('admin.Account.supplier', compact('supplier'));
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
    public function loadSuppliers(){
        $suppliers = ModelsSupplier::all();

        return response()->json($suppliers);
    }
    public function payables(ModelsSupplier $supplier)
    {
        $results= $supplier->supplierPayables;
        return view('admin.Account.supplierPayable', compact('supplier', 'results'));
    }
    public function filterPayables(Request $request)
    {
        $supplier = ModelsSupplier::find($request->supplier_id);
        if ($request->has('date')) {
            $dob = strtotime($request->date);
            $newDate = date('Y-m-d', $dob);
            $results = SupplierPayable::where('supplier_id', $request->supplier_id)->whereDate('created_at', $newDate)->get();
        } else if ($request->has('year')) {
            $results = SupplierPayable::where('supplier_id', $request->supplier_id)->whereYear('created_at', $request->year)->get();
        } else {
            $start = strtotime($request->daterange1);
            $newDate = date('Y-m-d', $start);
            $end = strtotime($request->daterange2);
            $newDate2 = date('Y-m-d', $end);
            $results = SupplierPayable::where('supplier_id', $request->supplier_id)->whereBetween('created_at', [$newDate, $newDate2])->get();
        }
        return view('admin.Account.supplierPayable', compact('results', 'supplier'));
    }
    public function purchases(ModelsSupplier $supplier)
    {
        $results= $supplier->supplierPurchases()->orderByDesc('created_at');
        return view('admin.Account.supplierPurchases', compact('supplier', 'results'));
    }
    public function filterPurchases(Request $request)
    {
        $supplier = ModelsSupplier::find($request->supplier_id);
        if ($request->has('date')) {
            $dob = strtotime($request->date);
            $newDate = date('Y-m-d', $dob);
            $results = SupplierPurchase::where('supplier_id', $request->supplier_id)->whereDate('created_at', $newDate)->get();
        } else if ($request->has('year')) {
            $results = SupplierPurchase::where('supplier_id', $request->supplier_id)->whereYear('created_at', $request->year)->get();
        } else {
            $start = strtotime($request->daterange1);
            $newDate = date('Y-m-d', $start);
            $end = strtotime($request->daterange2);
            $newDate2 = date('Y-m-d', $end);
            $results = SupplierPurchase::where('supplier_id', $request->supplier_id)->whereBetween('created_at', [$newDate, $newDate2])->get();
        }
        return view('admin.Account.supplierPurchases', compact('results', 'supplier'));
    }
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string',
            'contact_phone' => 'required',
            'contact_person_name' => 'sometimes',
            'address' => 'sometimes',
        ]);

        ModelsSupplier::create($validated);
        $notification = array(
            'message' => 'Supplier added created successfully!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ModelsSupplier $supplier)
    {
        //
        return view('admin.Account.supplierdetail', compact('supplier'));
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
    public function update(Request $request, ModelsSupplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'contact_phone' => 'required',
            'contact_person_name' => 'sometimes',
            'address' => 'sometimes',
        ]);

        $supplier->update($validated);
        $notification = array(
            'message' => 'Supplier Details updated successfully!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsSupplier $supplier)
    {
        $supplier->delete();
        $notification = array(
            'message' => 'Supplier Details deleted successfully!',
            'alert-type' => 'danger',
        );

        return back()->with($notification);

    }
}
