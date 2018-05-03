<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $permissions = Permission::paginate(20);

        return view('permission.index', compact('permissions'));
    }
    
    public function assign($role_id)
    {
        $role = Role::find($role_id);


        $current_permissions = $role->permissions;
        $permission_ids = array();
        foreach ($current_permissions as $current_permission) {
            array_push($permission_ids, $current_permission->id);
        }

        $permissions = Permission::all();
        return view('permission.assignToRole', compact('role', 'permissions', 'permission_ids'));
    }

    
    public function assign_store(request $request)
    {
        $role = Role::find($request->input('role_id'));
        if($request->input('permission') !== null){
            $role->syncPermissions($request->input('permission'));
        }else{
            $role->syncPermissions([]);
        }
        return redirect(route('role.index'))->with('flash_message', 'Permission successfully assigned to role!'); 
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Permission::create($requestData);

        return redirect(route('permission.index'))->with('flash_message', 'Permission added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        return view('permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $permission = Permission::findOrFail($id);
        $permission->update($requestData);

        return redirect(route('permission.index'))->with('flash_message', 'Permission updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Permission::destroy($id);

        return redirect(route('permission.index'))->with('flash_message', 'Permission deleted!');
    }
}
