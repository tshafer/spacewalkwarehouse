<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class AddFieldsToUsersTables extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table( 'users', function ( Blueprint $table ) {
                if ( ! Schema::hasColumn( 'placement', 'website',
                    'specialization' . 'designations' )
                ) {
                    $table->string( 'placement' );
                    $table->string( 'website' );
                    $table->string( 'specialization' );
                    $table->string( 'designations' );
                }
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
