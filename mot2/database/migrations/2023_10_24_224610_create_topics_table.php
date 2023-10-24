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
        Schema::create('topics', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('title', 50)->nullable(false)->comment('件名');
            $table->string('text', 500)->nullable(false)->comment('本文');
            $table->foreignId('user_id')->nullable(false)->constrained()->comment('投稿者');
            $table->datetime('posted_at')->useCurrent()->comment('作成日時');
            $table->datetime('updated_at')->useCurrentOnUpdate()->comment('更新日時');
            $table->softDeletes()->comment('論理削除日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
