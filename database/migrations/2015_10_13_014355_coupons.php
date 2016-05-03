<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Coupons extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function ($table) {
            $table->increments('id');
            $table->text('code');
            $table->integer('duration');
            $table->decimal('amount_off', 15, 2);
            $table->integer('duration_in_months');
            $table->integer('max_redemptions');
            $table->integer('percent_off');
            $table->dateTime('redeem_by');
            $table->integer('event_id');
            $table->softDeletes();
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
        Schema::dropIfExists('coupons');
    }
}
