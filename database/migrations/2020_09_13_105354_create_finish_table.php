<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finish', function (Blueprint $table) {
            $table->Increments('id');
            
            $table->integer('beli_id')->unsigned();
            $table->foreign('beli_id')->references('id')->on('beli')->onDelete('restrict');

            $table->integer('status')->unsigned()->nullable();
            $table->foreign('status')->references('id')->on('t_status')->ondelete('restrict');

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
        Schema::dropIfExists('finish');
    }
}
