<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //
    public function index()
    {
        // fetch all permissions
        $permissions = Permission::all();

        // pass data to the view
        return view('permissions.index')->with(
            ['permissions' => $permissions]
        );
    }

    public function create()
    {
        // fetch all permissions
        $roles = Role::all();
        // pass data to the view
        return view('permissions.create')->with(
            ['roles' => $roles]
        );
    }

    public function store(Request $request)
    {
        // validate form fields
        $request->validate([
            'name' => 'required|unique:permissions|max:100',
        ]);
        //extract name from request
        $name = $request['name'];
        // store role to db
        $permit = new Permission();
        $permit->name = $name;
        // save to db
        $permit->save();
        
        if (!empty($request['roles'])) {
            // extract roles from request
            $roles = $request['roles'];
            // loop through roles
            foreach ($roles as $role) {
                // check if role is valid
                $r = Role::where('id', $role)->firstOrFail();
                // fetch created permission
                $permission = Permission::where('name', $name)->firstOrFail();
                // assign permission to role
                $r->givePermissionTo($permission);
            }
            // redirect to index
        return redirect()->route('permissions.index');
        }
        // redirect to index
        return redirect()->route('permissions.index');
    }

    public function updatePermission(Request $request, $id)
    {
        // find permission in db
        $permission = Permission::findOrFail($id);
        // validate the form fields
        $request->validate([
            'name' => 'required|max:100|unique:permissions,name,' . $id,
        ]);
        // extract permission from request
        $permit = $request['name'];
        // update permission
        $permission->update(['name' => $permit]);
        // redirect back to index
        return redirect()->route('permissions.index');
    }

    public function deletePermission(Request $request)
    {

        // find permission in db
        $permission = Permission::findOrFail($request->permission_id);

        if($permission->name == 'Administer roles and permissions') {
            // notify user 
            return redirect()->route('permissions.index');
        }
        // delete permission from db
        $permission->delete();
        // redirect back to index
        return redirect()->route('permissions.index');
    }
}
