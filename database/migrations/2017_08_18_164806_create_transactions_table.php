<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id');
            $table->string('sales_record_no');
            $table->string('buyer_email');
            $table->string('buyer_user_first_name');
            $table->string('buyer_user_last_name');
            $table->timestamp('transaction_created_at');
            $table->bigInteger('item_id');
            $table->string('site');
            $table->text('item_title');
            $table->string('sku');
            $table->string('condition');
            $table->integer('quantity');
            $table->string('ebay_transaction_id');
            $table->decimal('transaction_price');
            $table->string('order_line_item_id');
            $table->text('shipment_tracking_details');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
