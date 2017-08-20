<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('store_id');
            $table->string('ebay_order_id');
            $table->string('order_status');
            $table->decimal('adjustment_amount');
            $table->decimal('amount_paid');
            $table->decimal('amount_saved');
            $table->timestamp('created_time')->nullable();
            $table->string('payment_method');
            $table->decimal('sub_total');
            $table->decimal('total');
            $table->string('buyer_user_id');
            $table->timestamp('paid_time')->nullable();
            $table->timestamp('shipped_time')->nullable();
            $table->string('payment_hold_status');
            $table->string('extended_order_id');
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
        Schema::dropIfExists('orders');
    }
}
