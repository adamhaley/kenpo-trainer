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
        //change table sessions to training_sessions
        Schema::rename('sessions', 'training_sessions');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //change table training_sessions to sessions
        Schema::rename('training_sessions', 'sessions');

    }
};
