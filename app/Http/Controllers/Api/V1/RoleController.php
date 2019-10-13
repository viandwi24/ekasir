<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Create a new BarangController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.jwt');
        $this->middleware('auth.permission:role-read');
        $this->middleware('auth.permission:role-create', ['only' => ['store']]);
        $this->middleware('auth.permission:role-update', ['only' => ['update','sync_permission']]);
        $this->middleware('auth.permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::all();       
        return response()->json([
            'status' => 'success',
            'data' => $role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required', 
        ]);

        $role = Role::create(['name' => $request->name]);

        return response()->json([
            'status' => 'success',
            'data' => $role
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::with('permissions')->find($id);
        return response()->json([
            'status' => 'success',
            'data' => $role
        ]);
    }
    public function show_byname($name)
    {
        $role = Role::with('permissions')->findByName($name);
        return response()->json([
            'status' => 'success',
            'data' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $request->validate([
            'name' => 'required', 
        ]);
        $update = $role->update($request->except(['id']));
        if (!$update) return response()->json([
            'status' => 'error',
            'error' => ['code' => 400, 'text' => 'update.failed'],
            'data' => $request->all()
        ], 400);
        return response()->json([
            'status' => 'success',
            'data' => $role
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $delete = $role->delete();
        if (!$delete) return response()->json([
            'status' => 'error',
            'error' => ['code' => 400, 'text' => 'delete.failed'],
            'data' => $request->all()
        ], 400);
        return response()->json([
            'status' => 'success',
            'data' => $id
        ]);
    }




    /**
     * Sync Permission
     */
    public function sync_permission(Request $request, $id)
    {
        $request->validate([
            "permissions" => 'required'
        ]);
        
        $permissions = json_decode($request->permissions);
        $role = Role::findOrFail($id);
        $role->syncPermissions($permissions);
        return response()->json([
            'status' => 'success',
            'data' => $role->permissions,
            'input' => $permissions
        ]);
    }
}
