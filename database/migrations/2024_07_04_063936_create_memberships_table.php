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
        Schema::create('memberships', function (Blueprint $table) {
            $table->uuid('membership_id')->primary();
            $table->date('start_date')->default(now());
            $table->date('expiry_date');
            $table->enum('membership_status', ['active', 'expired'])->default('active');
            $table->string('member_id');
            $table->foreign('member_id')->references('member_id')->on('members')->onDelete('cascade');
            $table->string('employee_id');
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
