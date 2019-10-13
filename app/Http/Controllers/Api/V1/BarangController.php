<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Barang;
class BarangController extends Controller
{
    /**
     * Create a new BarangController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.jwt');
        $this->middleware('auth.permission:barang-read');
        $this->middleware('auth.permission:barang-create', ['only' => ['store']]);
        $this->middleware('auth.permission:barang-update', ['only' => ['update']]);
        $this->middleware('auth.permission:barang-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        return response()->json([
            'status' => 'success',
            'data' => $barang
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
            'kode' => 'required|int', 
            'nama' => 'required', 
        ]);
        $store = Barang::create($request->except(['id']));
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
        $barang = Barang::findOrFail($id);
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
        $barang = Barang::findOrFail($id);
        $request->validate([
            'nama' => 'string', 
            'kelompok' => 'string', 
            'kelompok' => 'string', 
            'satuan' => 'int', 
            'harga_bruto' => 'int', 
            'pot1' => 'int', 
            'pot2' => 'int', 
            'ppn' => 'int', 
            'harga_beli' => 'int', 
            'naik' => 'int', 
            'harga_jual' => 'int', 
            'harga_jual_pembulatan' => 'int', 
            'stok' => 'int', 
            'stok_min' => 'int', 
            'diskon_jual' => 'int', 
        ]);
        $update = $barang->update($request->except(['id', 'kode']));
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
        $barang = Barang::findOrFail($id);
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