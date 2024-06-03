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
            $table->id()->comment('ユーザーID');
            $table->string('name')->default('')->nullable(false)->comment('ニックネーム');
            $table->string('nationality')->default('')->nullable()->comment('国籍');
            $table->string('introduction_text', 500)->default('')->nullable()->comment('自己紹介');
            $table->string('past_join')->default('')->nullable()->comment('IIMS活動参加歴(アーカイブ紐付け用)');
            $table->string('user_identifier', 50)->default('')->nullable()->comment('表示用ユーザーID');
            $table->string('user_icon')->default('')->nullable()->comment('アイコン画像');
            $table->string('user_cover_image')->default('')->nullable()->comment('アイコン画像');
            $table->string('sns_x')->default('')->nullable()->comment('X(Twitter)アカウントURL');
            $table->string('sns_facebook')->default('')->nullable()->comment('FacebookアカウントURL');
            $table->string('sns_instagram')->default('')->nullable()->comment('InstagramアカウントURL');
            $table->string('email')->unique()->default('')->nullable(false)->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable(); // 使用しないが無いとエラーになりそう
            $table->string('password')->nullable()->comment('パスワード');
            $table->rememberToken(); // 使用しないが無いとエラーになりそう
            $table->string('verify_token')->nullable()->comment('認証用トークン(会員登録時に使用)');
            $table->string('reset_password_access_key', 64)->unique()->nullable()->comment('パスワード再設定トークン');
            $table->timestamp('reset_password_expire_at')->nullable()->comment('パスワード再設定キーの有効期限');
            $table->tinyInteger('is_approved')->default(0)->nullable(false)->comment('承認フラグ 1:承認済');
            $table->tinyInteger('is_admin')->default(0)->nullable(false)->comment('管理者フラグ 1:管理者アカウント');
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
        Schema::dropIfExists('users');
    }
};
