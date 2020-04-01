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
        $permissions = Permission::all()->sortBy('name');
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
        $data = $request->validate([
            'name' => 'required|string',
        ]);

        if ($request->crud) {
            $crudder = ["create", "delete", "edit", "view"];
            foreach ($crudder as $value) {
                Permission::create([
                    'guard_name' => 'admin',
                    'name' => $request->name . "-" . $value,
                ]);
            }
        } else {
            Permission::create([
                'guard_name' => 'admin',
                'name' => $request->name,
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
        $permissions = Permission::all()->sortBy('name');
        return view('admin.acl.permission', compact('permissions', 'task'));
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
            'message' => $permission->name . ' permission deleted succesfully',
            'alert- type' => 'success'
        ];
        return redirect('admin/permission')->with($notification);
    }
}
