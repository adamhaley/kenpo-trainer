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
            //add boolean "done" column to training_session_technique table
            $table->boolean('done')->default(false)->after('training_session_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('technique_training_session', function (Blueprint $table) {
            //drop boolean "done" column from training_session_technique table
            $table->dropColumn('done');
        });
    }
};
