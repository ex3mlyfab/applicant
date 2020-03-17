<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.acl.permission', compact('permissions'));
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


        foreach ($request->name as $key => $name) {

            Permission::create([
                'guard_name' => 'admin',
                'name' => $request->name[$key],
            ]);
        }
        $notification = [
            'message' => ' permission added succesfully',
            'alert- type' => 'success'
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
    public function edit(Permission $permission)
    {
        //
        $task = $permission;
        $permissions = Permission::all();
        return view('admin.acl.permission', compact('permissions', 'permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
        $data = $request->validate([
            'name' => 'required'
        ]);
        $permission->update($data);
        $notification = [
            'message' => $request->name . ' permission updated succesfully',
            'alert- type' => 'success'
        ];
        return redirect('admin/permission')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        $notification = [
            'message' => $permission->name . ' permission updated succesfully',
            'alert- type' => 'success'
        ];
        return redirect('admin/permission')->with($notification);
    }
}
