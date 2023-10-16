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
        Schema::create('authorizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sessionId');
            $table->timestamp('createdAt');
            $table->string('method');
            $table->string('rfidTagUid');
            $table->timestamp('lastUpdatedAt');
            $table->string('source');
            $table->integer('id');  
            $table->string('rejectionReason')->nullable();
            $table->integer('userId');
            $table->string('status');
            $table->timestamps();
            $table->foreign('sessionId')->references('id')->on('sessions');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('authorizations');
    }
};
