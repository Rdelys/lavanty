<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// ✅ Ces deux lignes sont indispensables :
use Illuminate\Support\Facades\Mail;
use App\Mail\AuctionWonMail;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
            'category', // ✅ ajouté
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
        'end_time' => 'datetime:Y-m-d H:i:s',
    'start_time' => 'datetime:Y-m-d H:i:s',
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
        ->where('end_time', '<=', now())
        ->get();

    foreach ($products as $product) {
        if ($product->last_bid_user_id) {
            $product->update(['status' => 'adjugé']);

            // ✅ Envoyer un email au gagnant
            if ($product->lastBidUser && $product->lastBidUser->email) {
                Mail::to($product->lastBidUser->email)
                    ->send(new AuctionWonMail($product));
            }
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

protected function serializeDate(\DateTimeInterface $date)
{
    return $date->setTimezone(config('app.timezone'))->format('Y-m-d H:i:s');
}

}

