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
        //add many to many relationship between techniques and training_sessions
        Schema::create('technique_training_session', function (Blueprint $table) {
            $table->id();
            $table->foreignId('technique_id')->constrained();
            $table->foreignId('training_session_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //drop many to many relationship between techniques and training_sessions
        Schema::dropIfExists('technique_training_session');

    }
};
