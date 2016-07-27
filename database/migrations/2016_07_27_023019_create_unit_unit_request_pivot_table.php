<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitUnitRequestPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_unit_request', function (Blueprint $table) {
            $table->integer('unit_id')->unsigned()->index();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->integer('unit_request_id')->unsigned()->index();
            $table->foreign('unit_request_id')->references('id')->on('unit_requests')->onDelete('cascade');
            $table->primary(['unit_id', 'unit_request_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('unit_unit_request');
    }
}
