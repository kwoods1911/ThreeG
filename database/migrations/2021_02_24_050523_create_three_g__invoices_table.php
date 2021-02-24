<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreeGInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('three_g__invoices', function (Blueprint $table) {
            $table->id();
            $table->string('customerId');
            $table->string('managerid');
            $table->mediumText('packagedescription');
            $table->string('customername');
            $table->string('customeremail');
            $table->string('packagetrackingnumber');
            $table->double('shippingcost');
            $table->double('vattax');
            $table->double('customstax');
            $table->double('customsvat');
            $table->double('totalcost');
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
        Schema::dropIfExists('three_g__invoices');
    }
}
