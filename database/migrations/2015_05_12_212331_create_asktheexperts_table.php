<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class CreateAsktheexpertsTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create( 'asktheexperts', function ( Blueprint $table ) {
                $table->increments( 'id' );
                $table->string( 'first_name' );
                $table->string( 'last_name' );
                $table->string( 'phone' );
                $table->string( 'address' );
                $table->string( 'city' );
                $table->string( 'state' );
                $table->string( 'zip' );
                $table->string( 'body', 800 );
                $table->string( 'photo' );
                $table->string( 'placement', 1024 )->default( '' );
                $table->string( 'website', 1024 )->default( '' );
                $table->string( 'specialization', 1024 )->default( '' );
                $table->string( 'designations', 1024 )->default( '' );
                $table->string( 'peoples_names' );
                $table->string( 'need_name' );
                $table->string( 'need_email' );
                $table->string( 'need_phone' );
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
                $table->string( 'headline' );

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
            Schema::drop( 'asktheexperts' );
        }
    }
