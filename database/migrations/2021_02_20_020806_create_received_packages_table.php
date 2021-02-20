<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivedPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('received_packages', function (Blueprint $table) {
            $table->id();
            $table->string('managerid');
            $table->string('managername');
            $table->string('customerid');
            $table->string('customername');
            $table->string('newtrackingnumberbarcode');
            $table->string('packagedescription');
            $table->date('dateofarrival');
            $table->date('dateofdeparture');
            $table->string('locationstatus');
            $table->string('originaltrackingnumber');
            $table->string('deliverycustomercollection');
            $table->string('customer_invoice');
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
        Schema::dropIfExists('received_packages');
    }
}
