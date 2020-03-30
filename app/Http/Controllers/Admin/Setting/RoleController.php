<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.acl.role', compact('roles'));
    }
    public function assign(Request $request, Role $role)
    {
        $data = [];
        foreach ($request->name as $key => $value) {
            array_push($data, $request->name[$key]);
        }

        $role->syncPermissions($data);
        $notification = [
            'message' => 'Permission assigned successfully',
            'alert-type' => 'success'
        ];

        return back()->with($notification);
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
            'name' => 'required|unique:roles'
        ]);
        $data['guard_name'] = 'admin';
        Role::create($data);
        $notification = [
            'message' => $request->name . ' role added succesfully',
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
    public function show(Role $role)
    {
        $permissions = Permission::all()->sortBy('name');
        return view('admin.acl.assignrolepermission', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        $task = $role;
        $roles = Role::all();
        return view('admin.acl.role', compact('roles', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        $data = $request->validate([
            'name' => 'required|unique:roles'
        ]);
        $role->update($data);
        $notification = [
            'message' => $request->name . ' role updated succesfully',
            'alert- type' => 'success'
        ];
        return redirect('admin/role')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();
        $notification = [
            'message' => ' role updated succesfully',
            'alert- type' => 'success'
        ];
        return redirect('admin/role')->with($notification);
    }
}
