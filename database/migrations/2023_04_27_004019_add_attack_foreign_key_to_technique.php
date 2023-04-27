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
            //add attack_id field
            $table->unsignedBigInteger('attack_id')->nullable();
            $table->foreign('attack_id')->references('id')->on('attacks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('techniques', function (Blueprint $table) {
            //
            $table->dropForeign('technique_attack_id_foreign');
        });
    }
};
