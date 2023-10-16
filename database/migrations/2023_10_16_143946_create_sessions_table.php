<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sessionId');

            $table->integer('charge_point_id')->unsigned();
            $table->foreign('charge_point_id')->references('id')->on('charge_points')->onDelete('cascade');

            // $table->integer('chargePointId')->unsigned();
            $table->integer('userId');
            $table->timestamps();
            // $table->foreign('chargePointId')->references('id')->on('charge_points');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
