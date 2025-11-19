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
    DB::statement("SET GLOBAL time_zone = '+03:00'");
    DB::statement("SET time_zone = '+03:00'");
}

public function down()
{
    DB::statement("SET GLOBAL time_zone = '+00:00'");
    DB::statement("SET time_zone = '+00:00'");
}

};
