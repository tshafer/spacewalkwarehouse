<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class AddAddressToUsersTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table( 'users', function ( Blueprint $table ) {
                $table->string( 'sub_headline' );
                $table->string( 'address_2' );
                $table->string( 'address2_1' );
                $table->string( 'address2_2' );
                $table->string( 'address2_city' );
                $table->string( 'address2_state' );
                $table->string( 'address2_zip' );
                $table->string( 'address3_1' );
                $table->string( 'address3_2' );
                $table->string( 'address3_city' );
                $table->string( 'address3_state' );
                $table->string( 'address3_zip' );
            } );
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            //
        }
    }
