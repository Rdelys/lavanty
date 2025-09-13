<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'images',
        'starting_price',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'images' => 'array', // JSON -> tableau
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
}

