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
        //add default value of empty string to image field on belts table
        Schema::table('belts', function (Blueprint $table) {
            $table->string('image')->default('')->change();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //remove default value of empty string from image field on belts table
        Schema::table('belts', function (Blueprint $table) {
            $table->string('image')->change();
        });

    }
};
