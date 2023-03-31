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
        Schema::table('technique_training_session', function (Blueprint $table) {
            //add order column to pivot table
            $table->integer('order')->after('done')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('technique_training_session', function (Blueprint $table) {
            //drop order column
            $table->dropColumn('order');

        });
    }
};
