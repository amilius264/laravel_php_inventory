<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJualTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jual', function (Blueprint $table) {
            $table->Increments('id');

            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('t_status')->ondelete('restrict');

            $table->integer('sales_id')->unsigned();
            $table->foreign('sales_id')->references('id')->on('sales')->ondelete('restrict');

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');

            $table->string('faktur_no');
            $table->date('tanggal_jual');
            $table->date('tanggal_tempo');
            $table->integer('ppn')->nullable();
            $table->integer('g_total')->nullable();
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
        Schema::dropIfExists('jual');
    }
}
