<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStorePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('store');
            $table->string('sku');
            $table->decimal('price');
            $table->decimal('shipping_cost')->nullable();
            $table->decimal('handling_cost')->nullable();
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
        Schema::dropIfExists('store_prices');
    }
}
