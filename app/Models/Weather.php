<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    use HasFactory;

    protected $casts = [
        'coord' => 'json',
        'weather' => 'json',
        'main' => 'json',
        'wind' => 'json',
        'clouds' => 'json',
        'sys' => 'json',
    ];
}
