<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PredictionHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'weapon_id',
        'weapon_name',
        'input_price',
        'input_vfx',
        'input_rarity',
        'top_n',
        'recommendations',
        'response_payload',
        'status',
    ];

    protected $casts = [
        'recommendations' => 'array',
        'response_payload' => 'array',
    ];
}
