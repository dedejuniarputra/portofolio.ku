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
            $table->dropColumn([
                'issuer',
                'credential_id',
                'type',
                'category',
                'date',
                'credential_url'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->string('issuer')->nullable()->after('description');
            $table->string('credential_id')->nullable()->after('issuer');
            $table->string('type')->nullable()->after('credential_id');
            $table->string('category')->nullable()->after('type');
            $table->date('date')->nullable()->after('category');
            $table->string('credential_url')->nullable()->after('date');
        });
    }
};
