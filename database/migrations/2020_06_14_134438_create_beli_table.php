<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beli', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('suplier_id')->unsigned();
            $table->foreign('suplier_id')->references('id')->on('suplier')->onDelete('cascade');

            $table->date('tanggal_beli');
            $table->string('noinv');
            $table->text('note')->nullable();
            $table->timestamps();

        });
    }

    /**$table->date('tanggal_tempo');*/
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beli');
    }
}
