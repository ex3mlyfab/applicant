<?php

namespace App\Http\Controllers\Admin\Pharmacy;

use App\Http\Controllers\Controller;
use App\Models\DrugCategory;
use App\Models\DrugSubCategory;
use Illuminate\Http\Request;

class DrugCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugcategories = DrugCategory::all();
        return View('admin.pharmacy.drugcategories', compact('drugcategories'));
    }

    public function categoryAjax()
    {
        $sections = DrugCategory::all()->pluck("name", "id");
        return json_encode($sections);
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
            'name' => 'required|unique:drug_categories'
        ]);
        DrugCategory::create($data);
        $notification = [
            'message' => 'drug category created successfully',
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
    public function show(DrugCategory $drugcategory)
    {
        return view('admin.pharmacy.drugsubcategories', compact('drugcategory'));
    }

    public function subCategorystore(Request $request, DrugCategory $drugcategory)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $drugcategory->drugSubCategories()->create($data);
        $notification = [
            'message' => 'drug sub category created successfully',
            'alert-type' => 'success'
        ];
        return back()->with($notification);
    }
    public function drugAjax(DrugCategory $drug)
    {
        $subcategories = $drug->drugSubCategories->pluck("name", "id");
        return json_encode($subcategories);
    }

    public function subCategoryupdate(Request $request, DrugSubCategory $drugsubcategory)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);

        $drugsubcategory->update($data);
        $notification = [
            'message' => 'drug sub category updated successfully',
            'alert-type' => 'success'
        ];
        $task = $drugsubcategory;

        $drugcategory = DrugCategory::where('id', $task->drugCategory->id)->first();

        return view('admin.pharmacy.drugsubcategories', compact('drugcategory', 'notification'));
    }
    public function subCategorydelete(Request $request, DrugSubCategory $drugsubcategory)
    {
        $drugsubcategory->delete();
        $notification = [
            'message' => 'drug sub category deleted successfully',
            'alert-type' => 'success'
        ];
        return back()->with($notification);
    }
    public function subCategoryedit(DrugSubCategory $drugsubcategory)
    {
        $task = $drugsubcategory;

        $drugcategory = DrugCategory::where('id', $task->drugCategory->id)->first();

        return view('admin.pharmacy.drugsubcategories', compact('task', 'drugcategory'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DrugCategory $drugcategory)
    {
        //
        $task = $drugcategory;
        $drugcategories = DrugCategory::all();
        return View('admin.pharmacy.drugcategories', compact('drugcategories', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DrugCategory $drugcategory)
    {
        //
        $data = $request->validate([
            'name' => 'required'
        ]);
        $drugcategory->update($data);
        $notification = [
            'message' => 'drug category created successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('drugcategory.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DrugCategory $drugcategory)
    {
        $drugcategory->delete();
        $notification = [
            'message' => 'drug category created successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('drugcategory.index')->with($notification);
    }
}
