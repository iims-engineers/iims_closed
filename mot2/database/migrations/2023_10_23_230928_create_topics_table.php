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
            $table->increments('id')->comment('ID');
            $table->string('title', 50)->nullable(false)->comment('件名');
            $table->string('text', 500)->nullable(false)->comment('本文');
            $table->integer('user_id')->nullable(false)->comment('投稿者');
            $table->datetime('posted_at')->useCurrent()->comment('作成日時');
            $table->datetime('updated_at')->useCurrentOnUpdate()->comment('更新日時');
            $table->boolean('is_deleted')->default(false)->comment('論理削除フラグ true:論理削除');
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
