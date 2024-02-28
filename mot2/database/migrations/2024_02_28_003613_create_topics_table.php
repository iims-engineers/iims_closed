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
            $table->id();
            $table->string('title')->nullable()->comment('タイトル');
            $table->string('content')->nullable(false)->comment('コンテンツ');
            $table->unsignedBigInteger('user_id')->nullable(false)->comment('投稿者(users.id)');
            $table->foreign('user_id')->references('id')->on('users'); // usersテーブルのidカラムに外部キー制約
            $table->timestamps();
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
