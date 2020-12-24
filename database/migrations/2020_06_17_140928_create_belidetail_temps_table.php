<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelidetailTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('belidetail_temps', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('cascade');
            $table->integer('Temp_price');
            $table->integer('Temp_jumlah');
            $table->Integer('satuan_id')->unsigned();
            $table->foreign('satuan_id')->references('id')->on('satuan')->onDelete('cascade');
            $table->integer('Temp_ppn');
            $table->integer('Temp_diskon');
            $table->integer('Temp_total');
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
        Schema::dropIfExists('belidetail_temps');
    }
}
