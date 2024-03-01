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
            $table->id();
            $table->string('comment')->nullable(false)->comment('コメント');
            $table->unsignedBigInteger('topic_id')->nullable(false)->comment('コメント先のトピック(topics.id)');
            $table->foreign('topic_id')->references('id')->on('topics'); // topicsテーブルのidカラムに外部キー制約
            $table->unsignedBigInteger('user_id')->nullable(false)->comment('コメント主(users.id)');
            $table->foreign('user_id')->references('id')->on('users'); // usersテーブルのidカラムに外部キー制約
            $table->timestamps();
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
