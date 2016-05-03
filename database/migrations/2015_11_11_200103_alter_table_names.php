<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableNames extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            //$table->renameColumn('vip_ticket_price', 'alt_ticket_price');
            //$table->renameColumn('vip_ticket_name', 'alt_ticket_name');
            //$table->renameColumn('vip_max_tickets', 'alt_max_tickets');
            //$table->renameColumn('extra_fields_json', 'extra_fields');
            //$table->dropColumn('extra_fields_json_answers');
        });
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
