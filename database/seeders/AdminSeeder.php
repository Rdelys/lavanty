<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'lavanty@gmail.com'],
            [
                'password' => Hash::make('bY91RHAAE1YQ35Cc')
            ]
        );
    }
}
