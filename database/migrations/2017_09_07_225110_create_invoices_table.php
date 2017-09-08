<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id');
            $table->bigInteger('transaction_id');
            $table->string('sku');
            $table->string('store_type');
            $table->string('store_name');
            $table->string('next_state');
            $table->decimal('sold_price');
            $table->decimal('product_cost');
            $table->decimal('shipping_cost');
            $table->decimal('handling_cost');
            $table->decimal('fees');
            $table->decimal('profit');
            $table->string('message')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
