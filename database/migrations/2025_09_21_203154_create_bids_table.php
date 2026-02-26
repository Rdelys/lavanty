<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('bids', function (Blueprint $table) {

            $table->id();

            // Relation avec users
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            // Relation avec products
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete();

            // Montant de l'enchère
            $table->decimal('amount', 15, 2);

            // Indique si c’est une enchère automatique
            $table->boolean('is_auto_bid')->default(false);

            // Montant maximum si auto-bid
            $table->decimal('max_auto_bid', 15, 2)->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Index pour performance
            |--------------------------------------------------------------------------
            */

            $table->index(['product_id', 'amount']); // tri rapide des enchères
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
