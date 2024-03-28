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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id',36)->primary();
            // $table->id();
            $table->string('first_name', 64)->nullable();
            $table->string('last_name', 64)->nullable();
            $table->string('email', 64)->unique();
            $table->string('password', 255);
            $table->string('contact_no', 16)->nullable();
            $table->string('address', 256)->nullable();
            $table->tinyInteger('is_active')->default(0); // 0 or 1
            $table->string('invitation_token', 64)->nullable();
            $table->enum('status', ['I', 'A', 'R'])->default('I'); // I=Invited, A=Accepted, R=Rejected
            $table->timestamps(); // Created_at and Updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};