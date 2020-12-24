<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJualdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jualdetail', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedinteger('jual_id');
            $table->foreign('jual_id')->references('id')->on('jual')->onDelete('cascade');

            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('barang')->onDelete('restrict');

            $table->Integer('satuan_id')->unsigned();
            $table->foreign('satuan_id')->references('id')->on('satuan')->onDelete('restrict');

            $table->integer('qty');
            $table->integer('price')->nullable();
            $table->integer('disc')->nullable();
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
        Schema::dropIfExists('jualdetail');
    }
}
