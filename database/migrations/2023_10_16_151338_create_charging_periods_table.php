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
        Schema::create('charging_periods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sessionId');
            $table->decimal('amount', 10, 2);
            $table->timestamp('stoppedAt');
            $table->timestamp('startedAt');
            $table->string('state');
            $table->decimal('energy', 10, 2);
            $table->timestamps();
            $table->foreign('sessionId')->references('id')->on('sessions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charging_periods');
    }
};
