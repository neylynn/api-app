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
            $table->unsignedBigInteger('log_id'); // Foreign key to link to logs table
            $table->integer('socPercent')->nullable();
            $table->string('extendingSessionId')->nullable();
            $table->string('lastUpdatedAt');
            $table->integer('nonBillableEnergy');
            $table->integer('connectorId')->nullable();
            $table->decimal('authorizationId', 10, 2);
            $table->string('startedAt');
            $table->string('idTag');
            $table->string('externalSessionId')->nullable();
            $table->integer('terminalId')->nullable();
            $table->string('paymentType');
            $table->integer('tariffSnapshotId')->nullable();
            $table->string('paymentMethodId');
            $table->string('currency');
            $table->unsignedBigInteger('sessionId');
            $table->unsignedBigInteger('chargePointId');
            $table->string('paymentStatus')->nullable();
            $table->decimal('energy', 10, 2);
            $table->decimal('amount', 10, 2);
            $table->string('paymentStatusUpdatedAt')->nullable();
            $table->decimal('evsePhysicalReference', 10, 2);
            $table->string('idTagLabel')->nullable();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('evseId');
            $table->decimal('powerKw', 10, 2);
            $table->string('stoppedAt')->nullable();
            $table->decimal('electricityCost', 10, 2)->nullable();
            $table->boolean('reimbursementEligibility');
            $table->string('status');
            $table->timestamps();
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
