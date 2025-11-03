<?php

namespace App\Jobs;

use App\Models\Bid;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessAutoBidJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $auto;
    public $productId;
    public $proposed;

    /**
     * Crée une nouvelle instance du job
     */
    public function __construct($auto, $productId, $proposed)
    {
        $this->auto = $auto;
        $this->productId = $productId;
        $this->proposed = $proposed;
    }

    /**
     * Exécuter le job
     */
    public function handle()
    {
        $product = Product::find($this->productId);
        if (! $product) return;

        // Création de l'enchère
        Bid::create([
            'user_id' => $this->auto->user_id,
            'product_id' => $product->id,
            'amount' => $this->proposed
        ]);

        // Mettre à jour le produit
        $product->last_bid_user_id = $this->auto->user_id;
        $remaining = $product->end_time->diffInSeconds(now());
        if ($remaining <= 300) {
            $product->end_time = $product->end_time->addMinutes(5);
        }
        $product->save();
    }
}
