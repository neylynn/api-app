<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_id',
        'notification',
        'socPercent',
        'extendingSessionId',
        'lastUpdatedAt',
        'nonBillableEnergy',
        'connectorId',
        'authorizationId',
        'startedAt',
        'idTag',
        'externalSessionId',
        'terminalId',
        'paymentType',
        'tariffSnapshotId',
        'paymentMethodId',
        'currency',
        'sessionId',
        'socPercent',
        'chargePointId',
        'paymentStatus',
        'energy',
        'amount',
        'paymentStatusUpdatedAt',
        'evsePhysicalReference',
        'idTagLabel',
        'userId',
        'evseId',
        'powerKw',
        'stoppedAt',
        'electricityCost',
        'reimbursementEligibility',
        'status',
    ];
}
