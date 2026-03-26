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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('company_logo')->nullable();
            $table->string('title');
            $table->string('location')->nullable();
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->string('duration')->nullable();
            $table->string('type')->nullable(); // Internship, Full-time, etc.
            $table->string('mode')->nullable(); // Hybrid, Onsite, Remote
            $table->json('responsibilities')->nullable();
            $table->json('learnings')->nullable();
            $table->json('impact')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
