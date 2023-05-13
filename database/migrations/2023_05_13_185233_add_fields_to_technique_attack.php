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
        Schema::table('technique_attack', function (Blueprint $table) {
            //foreign key to tecnique table
            $table->foreignId('technique_id')->constrained();
            //foreign key to attack table
            $table->foreignId('attack_id')->constrained();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('technique_attack', function (Blueprint $table) {
            //drop foreign keys
            $table->dropForeign(['technique_id']);
            $table->dropForeign(['attack_id']);
        });
    }
};
