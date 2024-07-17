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
        Schema::create('book_purchases', function (Blueprint $table) {
            $table->uuid('purchase_id')->primary();
            $table->string('class_number', 30);
            $table->string('book_number', 30);
            $table->string('title', 225);
            $table->string('sub_title', 225)->nullable();
            $table->string('edition_statement', 225)->nullable();
            $table->string('number_of_pages', 100);
            $table->string('publication_year', 4);
            $table->string('series_statement', 224)->nullable();
            $table->date('added_date')->default(now());
            $table->integer('quantity');
            $table->string('online', 225)->nullable();
            $table->string('image_id', 225);
            $table->foreign('image_id')->references('image_id')->on('cover_images')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_purchases');
    }
};
