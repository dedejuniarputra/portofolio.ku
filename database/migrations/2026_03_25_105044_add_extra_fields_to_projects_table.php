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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('type')->nullable()->after('status'); // Web, Mobile, etc.
            $table->string('category')->nullable()->after('type'); // Proyek Pribadi, Magang, etc.
            $table->boolean('is_active')->default(true)->after('category');
            $table->integer('views_count')->default(0)->after('is_active');
            $table->json('reactions')->nullable()->after('views_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['type', 'category', 'is_active', 'views_count', 'reactions']);
        });
    }
};
