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
            $table->unsignedBigInteger('sessionId');
            $table->decimal('amount', 10, 2);
            $table->string('stoppedAt')->nullable();
            $table->string('startedAt')->nullable();
            $table->string('state');
            $table->decimal('energy', 10, 2);
            $table->timestamps();
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
