<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangRusakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_rusak', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('barang_id')->unsigned();
            $table->string('keterangan', 50);
            $table->integer('sat');
            $table->integer('qty');
            $table->integer('harga');
            $table->integer('jumlah');
            $table->integer('total_qty');
            $table->integer('total_jumlah');
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
        Schema::dropIfExists('barang_rusak');
    }
}
