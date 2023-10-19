<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogData extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification',
        'evseId',
        'externalSessionId',
        'sessionId',
        'chargePointId',
    ];
}
