<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ⚠️ On doit modifier le type ENUM avec une requête brute
        DB::statement("ALTER TABLE products MODIFY COLUMN status ENUM('en_cours', 'terminé', 'adjugé', 'à_venir') NOT NULL DEFAULT 'en_cours'");
    }

    public function down(): void
    {
        // 🧩 Si on veut revenir en arrière
        DB::statement("ALTER TABLE products MODIFY COLUMN status ENUM('en_cours', 'terminé', 'adjugé') NOT NULL DEFAULT 'en_cours'");
    }
};
