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
        Schema::create('book_purchases_book_onlines', function (Blueprint $table) {
            $table->uuid('book_purchases_book_onlines_id')->primary();
            $table->string('purchase_id');
            $table->foreign('purchase_id')->references('purchase_id')->on('book_purchases');
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
        Schema::dropIfExists('book_purchases_book_onlines');
    }
};
