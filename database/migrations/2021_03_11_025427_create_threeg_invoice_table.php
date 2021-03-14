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
            
            $table->id();
            $table->string('packageid');
            $table->string('managerid');
            $table->string('manager_name');
            $table->string('customer_id');
            $table->string('customer_name');
            $table->string('package_tracking_number');


            $table->mediumText('package_description');
            $table->integer('package_weight');
            $table->string('item_category');
            $table->double('shipping_cost');
            $table->double('shipping_cost_vat');
            $table->double('shipping_cost_total');

            
            $table->double('item_value');
            $table->double('customs_rate');
            $table->double('customs_tax_amount');
            $table->double('customs_tax_amount_vat');
            $table->double('customs_tax_total');

            $table->double('processing_fee');
            $table->double('processing_fee_vat');
            $table->double('processing_fee_total');


            $table->double('subtotal');
            $table->double('subtotal_vat');
            $table->double('final_total');
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
