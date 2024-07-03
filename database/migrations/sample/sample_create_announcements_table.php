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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('title')->default('')->nullable(false)->comment('タイトル');
            $table->string('content', 1000)->default('')->nullable(false)->comment('本文');
            $table->unsignedBigInteger('user_id')->nullable(false)->comment('作成者(users.id)');
            $table->foreign('user_id')->references('id')->on('users'); // usersテーブルのidカラムに外部キー制約
            $table->date('pub_start_at')->nullable()->comment('公開開始日');
            $table->date('pub_end_at')->nullable()->comment('公開終了日');
            $table->tinyInteger('is_public')->default(0)->nullable(false)->comment('公開フラグ 1:公開中');
            $table->timestamp('created_at')->useCurrent()->comment('作成日時');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新日時');
            $table->softDeletes()->default(null)->nullable()->comment('論理削除日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
