<?php

use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function ($table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description');
            $table->text('address');
            $table->text('city');
            $table->text('state');
            $table->text('zip_code');
            $table->text('country');
            $table->integer('max_tickets');
            $table->timestamp('event_start');
            $table->timestamp('event_end');
            $table->decimal('price', 5, 2);
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
        Schema::dropIfExists('events');
    }
}
