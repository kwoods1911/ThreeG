<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomRateToThreegInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('threeg_invoice', function (Blueprint $table) {
            $table->double('customs_tax_rate');
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
            $table->double('customs_tax_rate');
        });
    }
}
