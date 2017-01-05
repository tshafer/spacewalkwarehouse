<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDropCompanyNameAddBranchNameToUnitRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('unit_requests', function (Blueprint $table) {
            $table->dropColumn('company_name');
            $table->dropColumn('email');
            $table->dropColumn('company_website');
            $table->text('branch_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unit_requests', function (Blueprint $table) {
            $table->dropColumn('branch_name');
            $table->text('company_name');
            $table->text('email');
            $table->text('company_website');
        });
    }
}
