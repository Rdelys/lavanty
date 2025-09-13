<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->enum('status', ['a_venir', 'en_cours', 'termine'])->default('en_cours');
        $table->boolean('mise_en_vente')->default(true);
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn(['status', 'mise_en_vente']);
    });
}

};
