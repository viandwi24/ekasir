<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangRusak;

class BarangRusakController extends Controller
{
    /**
     * Create a new BarangController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.jwt');
        $this->middleware('auth.permission:barangrusak-read');
        $this->middleware('auth.permission:barangrusak-create', ['only' => ['store']]);
        $this->middleware('auth.permission:barangrusak-update', ['only' => ['update']]);
        $this->middleware('auth.permission:barangrusak-delete', ['only' => ['destroy']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => BarangRusak::all()
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
            'barang_id' => 'required|int',
        ]);

        $store = BarangRusak::create($request->except(['id']));

        return response()->json([
            'status' => 'success',
            'data' => $store
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
        $barang = BarangRusak::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data' => $barang
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
        $barang = BarangRusak::findOrFail($id);

        $request->validate([
            'keterangan' => 'string', 
            'sat' => 'integer', 
            'qty' => 'integer', 
            'harga' => 'integer', 
            'jumlah' => 'integer', 
            'total_qty' => 'integer', 
            'total_jumlah' => 'integer', 
        ]);

        $update = $barang->update($request->except(['barang_id', 'id']));

        if (!$update) return response()->json([
            'status' => 'error',
            'error' => ['code' => 400, 'text' => 'update.failed'],
            'data' => $request->all()
        ], 400);

        return response()->json([
            'status' => 'success',
            'data' => $request->all()
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
        $barang = BarangRusak::findOrFail($id);

        $delete = $barang->delete();

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
