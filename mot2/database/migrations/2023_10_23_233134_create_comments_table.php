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
            $table->increments('id')->comment('ID');
            $table->string('comment', 500)->comment('コメント');
            $table->integer('topic_id')->comment('トピックID');
            $table->integer('user_id')->comment('投稿者');
            $table->datetime('posted_at')->useCurrent()->comment('投稿日時');
            $table->boolean('is_deleted')->default(false)->comment('論理削除フラグ true:論理削除');
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
