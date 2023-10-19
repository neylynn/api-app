<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChargingPeriod extends Model
{
    use HasFactory;

    protected $fillable = [
        'sessionId',
        'amount',
        'stoppedAt',
        'startedAt',
        'state',
        'energy',
    ];
}
