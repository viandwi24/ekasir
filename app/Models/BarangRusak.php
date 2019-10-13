<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangRusak extends Model
{
    protected $table = 'barang_rusak';
    protected $fillable = [
        'barang_id', 
        'keterangan', 
        'sat', 
        'qty', 
        'harga', 
        'jumlah', 
        'total_qty', 
        'total_jumlah', 
    ];
}
