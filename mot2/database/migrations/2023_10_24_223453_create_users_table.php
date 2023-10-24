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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('last_name', 50)->comment('姓');
            $table->string('first_name', 50)->comment('名');
            $table->string('last_name_kana', 50)->comment('姓(カナ)');
            $table->string('first_name_kana', 50)->comment('名(カナ)');
            $table->string('initial', 20)->comment('イニシャル');
            $table->date('birthday')->comment('生年月日');
            $table->string('nationality', 100)->comment('国籍');
            $table->string('introduction_text', 500)->comment('自己紹介');
            $table->string('password', 50)->nullable(false)->comment('パスワード');
            $table->string('email', 255)->nullable(false)->comment('メールアドレス');
            $table->boolean('is_admin')->default(false)->comment('管理者権限 true:管理者');
            $table->datetime('created_at')->useCurrent()->comment('作成日時');
            $table->datetime('updated_at')->useCurrentOnUpdate()->comment('更新日時');
            $table->datetime('last_login_at')->comment('最終ログイン日時');
            $table->softDeletes()->comment('論理削除日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
