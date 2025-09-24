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
        'last_bid_user_id', // ✅ ajouté
    ];

    protected $casts = [
        'images' => 'array',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'mise_en_vente' => 'boolean',
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function lastBidUser()
    {
        return $this->belongsTo(User::class, 'last_bid_user_id');
    }

    // ✅ méthode réutilisable
    public static function checkExpiredAuctions()
{
    $products = self::query()
        ->where('status', 'en_cours')
        ->where('end_time', '<=', now()) // <= pour inclure pile à la seconde
        ->get();

    foreach ($products as $product) {
        if ($product->last_bid_user_id) {
            $product->update(['status' => 'adjugé']);
        } else {
            $product->update(['status' => 'terminé']);
        }
    }
}


    public function getFinalPriceAttribute()
{
    $lastBid = $this->bids()->orderByDesc('amount')->first();
    return $lastBid ? $lastBid->amount : $this->starting_price;
}
}

