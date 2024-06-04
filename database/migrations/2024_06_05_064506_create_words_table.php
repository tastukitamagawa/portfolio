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
        Schema::create('words', function (Blueprint $table) {
            $table->bigIncrements('word_id');
            $table->string('word');
            $table->string('meaning');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
        });
        
        Schema::create('dictionaries', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('word_id');
            $table->timestamp('updated_at');
            $table->timestamp('created_at');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('word_id')->references('word_id')->on('words')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('words');
        Schema::dropIfExists('dictionaries');
    }
};
