<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            // Gunakan if (!Schema::hasColumn...) untuk mencegah error jika kolom sudah ada
            if (!Schema::hasColumn('produks', 'kategori_id')) {
                $table->foreignId('kategori_id')->nullable()->constrained('kategoris')->onDelete('set null');
            }
        });
    }

    public function down(): void
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']);
            $table->dropColumn('kategori_id');
        });
    }
};