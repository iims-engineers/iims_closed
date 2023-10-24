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
            $table->id()->comment('ID');
            $table->string('comment', 500)->comment('コメント');
            $table->foreignId('topic_id')->nullable(false)->constrained()->comment('トピックID');
            $table->foreignId('user_id')->nullable(false)->constrained()->comment('ユーザーID');
            $table->datetime('posted_at')->useCurrent()->comment('投稿日時');
            $table->softDeletes()->comment('論理削除日時');
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
