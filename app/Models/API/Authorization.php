<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authorization extends Model
{
    use HasFactory;

    protected $fillable = [
        'sessionId',
        'createdAt',
        'method',
        'rfidTagUid',
        'lastUpdatedAt',
        'source',
        'rejectionReason',
        'userId',
        'status',
    ];
}
