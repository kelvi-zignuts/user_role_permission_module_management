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
        // Schema::create('role_user', function (Blueprint $table) {
        //     $table->uuid('id');
        //     $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('role_id')->constrained()->onDelete('cascade');
        //     // $table->timestamps();
        // });
        Schema::create('role_user', function (Blueprint $table) {
            // Remove the 'id' field
            // $table->uuid('id');
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            
            // Define the composite primary key
            $table->primary(['user_id', 'role_id']);
            
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};