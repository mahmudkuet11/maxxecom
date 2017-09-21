<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('store_id');
            $table->decimal('buy_it_now_price');
            $table->string('item_id');
            $table->timestamp('start_time')->nullable();
            $table->mediumText('view_item_url');
            $table->mediumText('view_item_url_for_natural_search');
            $table->string('listing_duration');
            $table->string('listing_type');
            $table->integer('quantity');
            $table->decimal('current_price');
            $table->boolean('is_global_shipping');
            $table->decimal('shipping_service_cost');
            $table->string('shipping_type');
            $table->timestamp('end_time')->nullable();
            $table->mediumText('title');
            $table->string('sku');
            $table->string('gallery_url');
            $table->enum('listing_status', \App\Enum\ListingType::keys());
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
        Schema::dropIfExists('items');
    }
}
