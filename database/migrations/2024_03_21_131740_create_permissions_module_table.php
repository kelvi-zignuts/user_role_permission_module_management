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
        Schema::create('permissions_module', function (Blueprint $table) {
            $table->id();
            // Change the type and attributes of module_code to match the code column in modules table
            $table->string('module_code', 8);
            $table->unsignedBigInteger('permission_id');
            $table->tinyInteger('create')->default(0);
            $table->tinyInteger('edit')->default(0);
            $table->tinyInteger('view')->default(0);
            $table->tinyInteger('delete')->default(0);
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('module_code')->references('code')->on('modules')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

            // Unique constraint to prevent duplicate entries
            $table->unique(['module_code', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions_module');
    }
};