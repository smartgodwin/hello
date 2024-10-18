<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view("backend.gestionRolePerm", compact("roles","permissions"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view("backend.createRolePerm", compact("permission"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255|unique:Roles,name',
            'permissions' => 'array',
        ]);

        $permissionsID = array_map(
            function($value){
                return (int)$value;
            },
            $request->input('permission', [])
        );


        $role = Role::create([
            'name' => $request->name,
        ]);

        if (!empty($permissionsID)) {
            $role->syncPermissions($permissionsID);
        }
        return redirect()->route('role.index')->with('success','Role create');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
