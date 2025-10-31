<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ⚠️ MySQL ne permet pas de modifier un ENUM facilement avec Blueprint
        // On utilise donc une requête brute ici
        DB::statement("ALTER TABLE `products` MODIFY `status` ENUM('en_cours', 'terminé', 'adjugé') DEFAULT 'en_cours'");
    }

    public function down(): void
    {
        // Pour revenir en arrière si besoin
        DB::statement("ALTER TABLE `products` MODIFY `status` ENUM('en_cours', 'terminé') DEFAULT 'en_cours'");
    }
};
