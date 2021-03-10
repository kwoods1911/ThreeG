<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPackageWeightToThreegInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('threeg_invoice', function (Blueprint $table) {
            $table->integer('package_weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('threeg_invoice', function (Blueprint $table) {
            // $table->dropColumn('package_weight');
        });
    }
}
