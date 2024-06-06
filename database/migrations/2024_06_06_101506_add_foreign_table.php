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
        Schema::table('dictionaries', function (Blueprint $table) {
            $table->dropForeign('dictionaries_user_id_foreign');
            $table->dropForeign('dictionaries_word_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dictionaries', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('word_id')->references('word_id')->on('words')->onDelete('cascade');
        });
    }
};
