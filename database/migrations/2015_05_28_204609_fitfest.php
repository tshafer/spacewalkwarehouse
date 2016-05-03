<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fitfest extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create( 'fitfest', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'first_name' );
            $table->string( 'last_name' );
            $table->string( 'email' );
            $table->string( 'class1' );
            $table->string( 'class2' );
            $table->string( 'class3' );

            $table->timestamps();
            $table->softDeletes();
        } );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop( 'fitfest' );
	}

}
