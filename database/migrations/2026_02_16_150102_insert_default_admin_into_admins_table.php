<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('admins')->insert([
            'email' => 'lavanty@gmail.com',
            'password' => Hash::make('bY91RHAAE1YQ35Cc'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        DB::table('admins')
            ->where('email', 'lavanty@gmail.com')
            ->delete();
    }
};
