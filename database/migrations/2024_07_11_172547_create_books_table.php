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
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('book_id')->primary();
            $table->string('class_number', 30);
            $table->string('book_number', 30);
            $table->string('barcode', 10)->unique();
            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->string('edition_statement')->nullable();
            $table->string('number_of_pages', 100);
            $table->string('publication_year', 4);
            $table->string('series_statement', 224)->nullable();
            $table->date('added_date')->default(now());
            $table->string('book_status', 20);
            $table->string('online')->nullable();
            $table->string('image_id');
            $table->foreign('image_id')->references('image_id')->on('cover_images');
            $table->string('publisher_id');
            $table->foreign('publisher_id')->references('publisher_id')->on('publishers');
            $table->softDeletes();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
