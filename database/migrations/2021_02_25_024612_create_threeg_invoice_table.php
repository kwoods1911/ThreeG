<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreegInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threeg_invoice', function (Blueprint $table) {
            $table->id('invoice_num');
            $table->string('packageid');
            $table->string('managerid');
            $table->mediumText('package_description');
            $table->string('customer_name');
            $table->string('package_tracking_number');
            $table->double('shipping_cost');
            $table->double('vat_tax');
            $table->double('customs_tax');
            $table->double('customs_vat');
            $table->double('total_cost');
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
        Schema::dropIfExists('threeg_invoice');
    }
}
