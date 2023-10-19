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
            $table->unsignedBigInteger('sessionId'); // Foreign key to link to sessions table
            $table->string('createdAt');
            $table->string('method');
            $table->string('rfidTagUid')->nullable();
            $table->string('lastUpdatedAt');
            $table->string('source');
            $table->text('rejectionReason')->nullable();
            $table->unsignedBigInteger('userId');
            $table->string('status');
            $table->timestamps();
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
