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
        Schema::create('meter_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sessionId');
            $table->string('unit');
            $table->string('measurand');
            $table->decimal('value', 10, 2);
            $table->timestamp('timestamp');
            $table->timestamps();
            $table->foreign('sessionId')->references('id')->on('sessions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_values');
    }
};
