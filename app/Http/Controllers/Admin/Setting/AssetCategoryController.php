<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\AssetCategory;
use Illuminate\Http\Request;

class AssetCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assetcategories = AssetCategory::all()->sortByDesc('name');
        return view('admin.asset.assetcategory', compact('assetcategories'));
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
            'name' => 'required|unique:asset_categories',
        ]);

        AssetCategory::create($data);
        $notification = [
            'message' => 'AssetCategory created successfully',
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
    public function edit(AssetCategory $assetcategory)
    {
        //
        $assetcategories = AssetCategory::all()->sortByDesc('name');
        $task = $assetcategory;

        return view('admin.account.AssetCategory', compact('assetcategories', 'task'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssetCategory $assetcategory)
    {
        //
        $data = $request->validate([
            'name' => 'required',
        ]);
        $assetcategory->update($data);

        $notification = [
            'message' => 'AssetCategory updated successfully',
            'alert-type' => 'success'
        ];
        return redirect('admin/assetcategory')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssetCategory $assetcategory)
    {
        //
        $assetcategory->delete();
        $notification = [
            'message' => 'AssetCategory deleted successfully',
            'alert-type' => 'info'
        ];
        return redirect('admin/assetcategory')->with($notification);
    }
}
