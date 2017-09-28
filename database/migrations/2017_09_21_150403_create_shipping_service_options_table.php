<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingServiceOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_service_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_id');
            $table->string('shipping_service');
            $table->decimal('shipping_service_cost');
            $table->decimal('shipping_service_additional_cost');
            $table->integer('shipping_service_priority');
            $table->decimal('surcharge');
            $table->integer('shipping_time_min');
            $table->integer('shipping_time_max');
            $table->boolean('free_shipping');
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
        Schema::dropIfExists('shipping_service_options');
    }
}
