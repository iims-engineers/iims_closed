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
        Schema::table('announcement_reads', function (Blueprint $table) {
            $table->tinyInteger('is_public')->default(1)->nullable(false)->comment('公開フラグ 1:公開中');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('announcement_reads', function (Blueprint $table) {
            $table->dropColumn('is_public');
        });
    }
};
