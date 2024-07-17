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
        Schema::create('books_book_onlines', function (Blueprint $table) {
            $table->uuid('books_book_onlines')->primary();
            $table->string('book_id');
            $table->foreign('book_id')->references('book_id')->on('books');
            $table->string('online_id');
            $table->foreign('online_id')->references('online_id')->on('book_onlines');
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_book_onlines');
    }
};
