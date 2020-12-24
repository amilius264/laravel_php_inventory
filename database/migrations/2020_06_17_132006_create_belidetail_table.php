<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBelidetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('belidetail', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedinteger('beli_id');
            $table->foreign('beli_id')->references('id')->on('beli')->onDelete('cascade');

            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('restrict');

            $table->Integer('satuan_id')->unsigned();
            $table->foreign('satuan_id')->references('id')->on('satuan')->onDelete('restrict');

            $table->integer('price');
            $table->integer('jumlah');
            $table->integer('diskon')->nullable();
            $table->integer('ppn')->nullable();
            $table->integer('total')->nullable();
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
        Schema::dropIfExists('belidetail');
    }
}
