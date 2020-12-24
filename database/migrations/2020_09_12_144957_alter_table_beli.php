<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableBeli extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('beli', function (Blueprint $table) {
            $table->integer('status')->unsigned()->nullable()->after('suplier_id');

            $table->foreign('status')->references('id')->on('t_status')->ondelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('beli', function (Blueprint $table) {
            //
        });
    }
}
