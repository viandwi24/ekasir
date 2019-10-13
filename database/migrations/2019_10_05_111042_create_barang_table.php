<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kode');

            $table->string('nama');
            $table->string('kelompok')->default("default");
            $table->string('gambar')->nullable();
            $table->text('keterangan')->nullable();

            $table->integer('satuan')->default(0);
            $table->integer('pot1')->nullable();
            $table->integer('pot2')->nullable();
            $table->integer('diskon_jual')->nullable();

            $table->integer('ppn')->default(0);
            $table->integer('naik')->nullable();

            $table->integer('harga_bruto')->default(0);
            $table->integer('harga_beli')->default(0);
            $table->integer('harga_jual')->default(0);
            $table->integer('harga_jual_pembulatan')->default(0);

            $table->integer('stok')->default(1);
            $table->integer('stok_min')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
