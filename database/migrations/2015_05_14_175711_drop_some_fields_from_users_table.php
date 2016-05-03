<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;

    class DropSomeFieldsFromUsersTable extends Migration
    {

        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::table( 'users', function ( Blueprint $table ) {
                $table->dropColumn( 'phone' );
                $table->dropColumn( 'address' );
                $table->dropColumn( 'city' );
                $table->dropColumn( 'state' );
                $table->dropColumn( 'zip' );
                $table->dropColumn( 'body');
                $table->dropColumn( 'photo' );
                $table->dropColumn( 'placement' );
                $table->dropColumn( 'website' );
                $table->dropColumn( 'specialization' );
                $table->dropColumn( 'designations' );
                $table->dropColumn( 'peoples_names' );
                $table->dropColumn( 'need_name' );
                $table->dropColumn( 'need_email' );
                $table->dropColumn( 'need_phone' );
                $table->dropColumn( 'sub_headline' );
                $table->dropColumn( 'address_2' );
                $table->dropColumn( 'address2_1' );
                $table->dropColumn( 'address2_2' );
                $table->dropColumn( 'address2_city' );
                $table->dropColumn( 'address2_state' );
                $table->dropColumn( 'address2_zip' );
                $table->dropColumn( 'address3_1' );
                $table->dropColumn( 'address3_2' );
                $table->dropColumn( 'address3_city' );
                $table->dropColumn( 'address3_state' );
                $table->dropColumn( 'address3_zip' );
                $table->dropColumn( 'headline' );
            } );
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::table( 'users', function ( Blueprint $table ) {
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
            } );
        }
    }
