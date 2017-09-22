<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('item_id');
            $table->boolean('auto_pay');
            $table->string('country');
            $table->string('currency');
            $table->text('description');
            $table->string('ebay_item_id');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->string('listing_type');
            $table->string('location');
            $table->string('payment_method');
            $table->string('paypal_email');
            $table->integer('primary_category_id');
            $table->string('primary_category_name');
            $table->string('upc');
            $table->string('brand');
            $table->integer('quantity');
            $table->decimal('weight_major');
            $table->decimal('weight_minor');
            $table->decimal('sales_tax_percent');
            $table->string('sales_tax_state');
            $table->boolean('is_shipping_included_in_tax');
            $table->string('shipping_type');
            $table->string('ship_to_location');
            $table->string('site');
            $table->integer('store_category_id');
            $table->integer('store_category2_id');
            $table->string('uuid');
            $table->string('postal_code');
            $table->string('gallery_url');
            $table->integer('dispatch_time_max');
            $table->string('refund_option');
            $table->string('returns_within_option');
            $table->string('returns_accepted_option');
            $table->text('return_policy_description');
            $table->string('return_shipping_cost_paid_by');
            $table->integer('condition_id');
            $table->boolean('hide_from_search');
            $table->boolean('out_of_stock_control');
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
        Schema::dropIfExists('item_details');
    }
}
