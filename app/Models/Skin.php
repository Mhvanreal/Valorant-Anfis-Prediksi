<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skin extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'weapon_id',
        'skin_name',
        'rarity',
        'status',
        'price',
        'image_url',
        'is_battlepass',
        'popularity',
        'vfx',
        'theme_uuid',
        'score',
    ];

    public function weapon()
    {
        return $this->belongsTo(Weapon::class);
    }

}
