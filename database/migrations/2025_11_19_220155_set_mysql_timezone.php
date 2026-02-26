<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        DB::statement("SET time_zone = '+03:00'");
    }

    public function down()
    {
        DB::statement("SET time_zone = '+00:00'");
    }
};