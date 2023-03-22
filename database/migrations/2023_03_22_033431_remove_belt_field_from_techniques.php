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
        Schema::table('techniques', function (Blueprint $table) {
            //remove belt field from techniques table
            $table->dropColumn('belt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('techniques', function (Blueprint $table) {
            //add belt field to techniques table
            $table->string('belt');
        });
    }
};
