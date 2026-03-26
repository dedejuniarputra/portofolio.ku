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
        Schema::table('achievements', function (Blueprint $table) {
            $table->string('credential_id')->nullable()->after('issuer');
            $table->string('type')->nullable()->after('credential_id'); // e.g., Profesional, Course
            $table->string('category')->nullable()->after('type'); // e.g., Backend, Mobile
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->dropColumn(['credential_id', 'type', 'category']);
        });
    }
};
