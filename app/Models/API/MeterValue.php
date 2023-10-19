<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'log_id',
        'unit',
        'measurand',
        'value',
        'timestamp',
    ];
}
