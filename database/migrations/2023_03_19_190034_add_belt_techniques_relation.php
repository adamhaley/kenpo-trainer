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
        //add foreign key relationship from belt to technique
        Schema::table('techniques', function (Blueprint $table) {
            //add belt_id field to techniques table that references id field on belts table
            $table->bigInteger('belt_id')->unsigned()->nullable();
            $table->foreign('belt_id')->references('id')->on('belts')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //remove belt_id column and foreign key relationship from belt to technique
        Schema::table('techniques', function (Blueprint $table) {
            //remove foreign key relationship from belt to technique
            $table->dropForeign('techniques_belt_id_foreign');

            //remove belt_id field from techniques table
            $table->dropColumn('belt_id');
        });
    }
};
