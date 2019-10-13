<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Create a new BarangController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.jwt');
        $this->middleware('auth.permission:permission-read');
        $this->middleware('auth.permission:permission-create', ['only' => ['store']]);
        $this->middleware('auth.permission:permission-update', ['only' => ['update']]);
        $this->middleware('auth.permission:permission-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permission = Permission::all();       
        return response()->json([
            'status' => 'success',
            'data' => $permission
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

        $permission = Permission::create(['name' => $request->name]);

        return response()->json([
            'status' => 'success',
            'data' => $permission
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
        $permission = Permission::find($id);
        return response()->json([
            'status' => 'success',
            'data' => $permission
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
        $permission = Permission::findOrFail($id);
        $request->validate([
            'name' => 'required', 
        ]);
        $update = $permission->update($request->except(['id']));
        if (!$update) return response()->json([
            'status' => 'error',
            'error' => ['code' => 400, 'text' => 'update.failed'],
            'data' => $request->all()
        ], 400);
        return response()->json([
            'status' => 'success',
            'data' => $permission
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
        $permission = Permission::findOrFail($id);
        $delete = $permission->delete();
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
}
