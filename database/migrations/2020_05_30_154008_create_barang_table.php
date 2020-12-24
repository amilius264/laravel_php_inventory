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
            $table->Integer('satuan_id')->unsigned();
            $table->foreign('satuan_id')->references('id')->on('satuan')->onDelete('restrict');
            $table->Integer('suplier_id')->unsigned();
            $table->foreign('suplier_id')->references('id')->on('suplier')->onDelete('restrict');
            $table->String('kode_brg');
            $table->String('nama_brg');
            $table->integer('stok');
            $table->integer('min_stok');
            $table->integer('harga');
            $table->text('note')->nullable();
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
