<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking_numbers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('scope', \App\Enum\TrackingNumberScope::keys());
            $table->bigInteger('reference_id');
            $table->string('carrier');
            $table->string('tracking_no');
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
        Schema::dropIfExists('tracking_numbers');
    }
}
