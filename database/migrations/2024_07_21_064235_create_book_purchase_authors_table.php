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
        Schema::create('book_purchase_authors', function (Blueprint $table) {
            $table->uuid('book_purchase_authors_id')->primary();
            $table->string('purchase_id');
            $table->foreign('purchase_id')->references('purchase_id')->on('book_purchases');
            $table->string('author_id');
            $table->foreign('author_id')->references('author_id')->on('authors');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_purchase_authors');
    }
};
