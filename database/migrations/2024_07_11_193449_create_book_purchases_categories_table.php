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
        Schema::create('book_purchases_categories', function (Blueprint $table) {
            $table->uuid('book_purchases_categories')->primary();
            $table->string('purchase_id');
            $table->foreign('purchase_id')->references('purchase_id')->on('book_purchases');
            $table->string('category_id');
            $table->foreign('category_id')->references('category_id')->on('categories');
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_purchases_categories');
    }
};
