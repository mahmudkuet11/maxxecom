<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('owner_id');
            $table->enum('site_mode', ['sandbox', 'production']);
            $table->string('name');
            $table->integer('site_id');

            $table->string('sandbox_dev_id');
            $table->string('sandbox_app_id');
            $table->string('sandbox_cert_id');
            $table->text('sandbox_auth_token');
            $table->text('sandbox_oauth_token');

            $table->string('production_dev_id');
            $table->string('production_app_id');
            $table->string('production_cert_id');
            $table->text('production_auth_token');
            $table->text('production_oauth_token');

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
        Schema::dropIfExists('stores');
    }
}
