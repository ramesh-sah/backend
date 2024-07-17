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
        Schema::create('books_isbns', function (Blueprint $table) {
            $table->uuid('books_isbns')->primary();
            $table->string('book_id');
            $table->foreign('book_id')->references('book_id')->on('books');
            $table->string('isbn_id');
            $table->foreign('isbn_id')->references('isbn_id')->on('isbns')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_isbns');
    }
};
