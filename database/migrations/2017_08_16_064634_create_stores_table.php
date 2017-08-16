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
            $table->string('name');
            $table->integer('site_id');

            $table->string('dev_id');
            $table->string('app_id');
            $table->string('cert_id');
            $table->text('auth_token');
            $table->text('oauth_token');

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
