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
        Schema::create('comments', function (Blueprint $table) {
            $table->id()->comment('コメントID');
            $table->string('comment')->default('')->nullable(false)->comment('コメント');
            $table->unsignedBigInteger('topic_id')->nullable(false)->comment('コメント先のトピック(topics.id)');
            $table->foreign('topic_id')->references('id')->on('topics'); // topicsテーブルのidカラムに外部キー制約
            $table->unsignedBigInteger('user_id')->nullable(false)->comment('コメント主(users.id)');
            $table->foreign('user_id')->references('id')->on('users'); // usersテーブルのidカラムに外部キー制約
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
        Schema::dropIfExists('comments');
    }
};
