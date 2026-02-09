<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $fillable = [
        'name',
        'city',
        'latitude',
        'longitude',
        'stars',
        'price_per_night',
    ];
}
