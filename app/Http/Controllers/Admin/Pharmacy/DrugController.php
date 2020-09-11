<?php

namespace App\Http\Controllers\Admin\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\DrugModel;
use App\Models\DrugClass;
use Illuminate\Http\Request;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugs = DrugModel::all()->sortBy('name');
        return view('admin.pharmacy.drug', compact('drugs'));
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
            'name' => 'required',
            'forms' => 'required',
            'strength' => 'nullable',
            'drug_class_id' => 'nullable',
            'maximum_level' => 'nullable',
            'minimum_level' => 'nullable',
            'reorder_level' => 'nullable',
        ]);

        DrugModel::create($data);
        $notification = [
            'message' => 'drug added successfully',
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
    public function show(DrugModel $drug)
    {
        return view('admin.pharmacy.drugdetail', compact('drug'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        //
        $drugs = DrugModel::all();
        return response()->json($drugs);
    }
    public function drugAjax(DrugClass $drug)
    {
        // $drug->drugModels->pluck("name", "id", "forms");
        $sections = DrugModel::select("id", "name", "forms")->where('drug_class_id', $drug->id)->get();
        return json_encode($sections);
    }
    public function selectDrug(DrugModel $drug){
        return response()->json($drug);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DrugModel $drug)
    {
        //dd($request->all());

        $data = $request->validate([
            'name' => 'required',
            'forms' => 'required',
            'strength' => 'nullable',
            'dosage' => 'nullable',
            'maximum_level' => 'nullable',
            'minimum_level' => 'nullable',
            'reorder_level' => 'nullable',
        ]);

        $drug->update($data);
        $notification = [
            'message' => 'drug updated successfully',
            'alert-type' => 'info'
        ];

        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrugModel $drug)
    {
        $drug->delete();
        $notification = [
            'message' => 'drug updated successfully',
            'alert-type' => 'info'
        ];

        return back()->with($notification);
    }
}
