<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('belts', function (Blueprint $table) {
            //make belt order default 0
            $table->integer('order')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('belts', function (Blueprint $table) {
            //remove default from belt order
            $table->integer('order')->change();

        });
    }
};
