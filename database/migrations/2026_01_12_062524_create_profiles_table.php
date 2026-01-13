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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Sufian Mahbub'); // Default for safety
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('experience_years')->default('0');
            $table->string('projects_completed')->default('0');
            $table->string('clients_satisfied')->default('0');
            $table->string('image')->nullable(); // Path to image
            $table->text('social_links')->nullable(); // JSON or Text for FB, LinkedIn etc. if needed later
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
