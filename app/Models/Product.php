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
    'status',
    'mise_en_vente',
];

protected $casts = [
    'images' => 'array',
    'start_time' => 'datetime',
    'end_time' => 'datetime',
    'mise_en_vente' => 'boolean',
];

}

