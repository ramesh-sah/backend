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
        Schema::create('book_reservations', function (Blueprint $table) {
            $table->uuid('reservation_id')->primary();
            $table->date('reservation_date')->default(now());
            $table->date('reservation_expiry_date')->default(now()->addDays(3));
            $table->string('status', 10)->default('open');
            $table->enum('reservation_status', ['pending', 'approved'])->default('pending');
            $table->string('member_id');
            $table->foreign('member_id')->references('member_id')->on('members')->onDelete('cascade');
            $table->string('employee_id')->nullable();
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->string('book_id')->nullable();
            $table->foreign('book_id')->references('book_id')->on('books')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_reservations');
    }
};
