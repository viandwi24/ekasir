<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = [
        'kode', 
        'nama', 
        'satuan', 
        'kelompok', 
        'harga_bruto', 
        'pot1', 
        'pot2', 
        'ppn', 
        'harga_beli', 
        'naik', 
        'harga_jual', 
        'harga_jual_pembulatan', 
        'stok', 
        'stok_min', 
        'keterangan', 
        'diskon_jual', 
        'gambar', 
    ];
}