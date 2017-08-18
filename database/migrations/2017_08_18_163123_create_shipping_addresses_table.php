<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id');
            $table->string('name');
            $table->string('street1');
            $table->string('street2');
            $table->string('city_name');
            $table->string('state_or_province');
            $table->string('country');
            $table->string('country_name');
            $table->string('phone');
            $table->string('postal_code');
            $table->string('address_id');
            $table->string('shipping_service_selected');
            $table->decimal('shipping_service_cost');
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
        Schema::dropIfExists('shipping_addresses');
    }
}
