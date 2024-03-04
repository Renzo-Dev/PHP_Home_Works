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
        Schema::table('categories_photos', function (Blueprint $table) {
            $table->unique(['category_id', 'photo_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories_photos', function (Blueprint $table) {
            // Удаляем уникальный ключ
            $table->dropUnique(['category_id', 'photo_id']);
        });
    }
};
