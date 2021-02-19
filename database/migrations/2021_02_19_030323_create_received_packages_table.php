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
            $table->string('newtrackingnumber/barcode');
            $table->string('customerid');
            $table->string('customername');
            $table->string('packagedescription');
            $table->date('dateofarrival');
            $table->date('dateofdeparture');
            $table->string('locationstatus');
            $table->string('originaltrackingnumber');
            $table->string('delivery/customercollection');
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
