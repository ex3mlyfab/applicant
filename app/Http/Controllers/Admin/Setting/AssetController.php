<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Models\AssetModel;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $assets = AssetModel::all()->sortBy('name');
        return view('admin.asset.asset', compact('assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'name' => 'required|unique:asset_models',
            'asset_category_id' => 'required',
            'unit' => 'nullable',
            'picture' => 'nullable'
        ]);
        if ($request->hasFile('picture')) {
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
            $file = $request->picture;

            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $storage_path = public_path() . '/backend/images/documents';
                $fileName = $request->name . Date('Y-m-d') . 'picture' . '.' . $extension;
                $file->move($storage_path, $fileName);
                $data['picture'] = $fileName;
            }
        }

        AssetModel::create($data);
        $notification = [
            'message' => 'Asset recorded succesfully',
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
    public function show(AssetModel $asset)
    {
        //
        return view('admin.asset.assetshow', compact('asset'));
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
    public function update(Request $request, AssetModel $asset)
    {
        //
        $data = $request->validate([
            'name' => 'required',
            'asset_category_id' => 'required',
            'unit' => 'nullable',
            'picture' => 'nullable'
        ]);
        if ($request->hasFile('picture')) {
            $allowedfileExtension = ['pdf', 'jpg', 'png', 'docx'];
            $file = $request->picture;

            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $storage_path = public_path() . '/backend/images/assets';
                $fileName = $request->name . Date('Y-m-d') . 'picture' . '.' . $extension;
                if (isset($asset->picture)) {
                    \File::delete($storage_path . '/' . $asset->picture);
                }
                $file->move($storage_path, $fileName);
                $data['picture'] = $fileName;
            }
        }

        $asset->update($data);
        $notification = [
            'message' => 'Asset updated succesfully',
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
    public function destroy(AssetModel $asset)
    {
        //
        $asset->delete();
        $notification = [
            'message' => 'Asset deleted succesfully',
            'alert-type' => 'info'
        ];
        return back()->with($notification);
    }
}
