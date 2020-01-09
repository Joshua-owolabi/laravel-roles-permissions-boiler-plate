<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    //

    public function index()
    {
        // fetch all roles
        $roles = Role::all();
        // fetch all permissions
        $permissions = Permission::all();

        // pass data to the view
        return view('roles.index')->with(
            ['roles' => $roles, 'permissions' => $permissions]
        );
    }

    public function create()
    {
        // fetch all permissions
        $permissions = Permission::all();
        // pass data to the view
        return view('roles.create')->with(
            ['permissions' => $permissions]
        );
    }

    public function store(Request $request)
    {
        // validate form fields
        $request->validate([
            'name' => 'required|unique:roles|max:10',
            'permissions' => 'required'
        ]);
        //extract name from request
        $name = $request['name'];
        // store role to db
        Role::create(['name' => $name]);
        // extract permissions from request
        $permissions = $request['permissions'];
        // loop through permissions
        foreach ($permissions as $permission) {
            // check if permission is valid
            $permit = Permission::where('id', $permission)->firstOrFail();
            // fetch created role
            $role = Role::where('name', $name)->firstOrFail();
            // assign permission to role
            $role->givePermissionTo($permit);
        }
        // redirect to index
        return redirect()->route('roles.index');
    }

    public function updateRole(Request $request, $id)
    {
        // find role in db
        $role = Role::findOrFail($id);
        // validate the form fields
        $request->validate([
            'name' => 'required|max:10|unique:roles,name,' . $id,
        ]);
        // extract name from request
        $name = $request['name'];
        // update role
        $role->update(['name' => $name]);


        if (!empty($request->permissions)) {

            // extract permissions from request
            $permissions = $request['permissions'];

            // fetch all permissions
            $allPermit = Permission::all();
            // remove previous permissions
            foreach ($allPermit as $p) {
                // remove permissions assigned to role
                $role->revokePermissionTo($p);
            }

            // loop through permissions
            foreach ($permissions as $permission) {
                // check if permission is valid
                $permit = Permission::where('id', $permission)->firstOrFail();
                // assign permission to role
                $role->givePermissionTo($permit);
            }
        }
        // redirect back to index
        return redirect()->route('roles.index');
    }

    public function deleteRole(Request $request)
    {

        // find role in db
        $role = Role::findOrFail($request->role_id);
        // delete role from db
        $role->delete();
        // redirect back to index
        return redirect()->route('roles.index');
    }
}
