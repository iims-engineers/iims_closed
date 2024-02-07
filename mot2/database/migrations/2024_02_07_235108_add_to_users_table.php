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
        Schema::table('users', function (Blueprint $table) {

            $table->string('name_kana')->after('name')->comment('カナ');
            $table->string('initial')->after('name_kana')->comment('イニシャル');
            $table->date('birthday')->after('initial')->comment('生年月日');
            $table->string('nationality')->after('birthday')->comment('国籍');
            $table->string('introduction_text', 500)->after('nationality')->comment('自己紹介');
            // $table->string('password', 50)->nullable(false)->comment('パスワード');
            // $table->string('email', 255)->nullable(false)->comment('メールアドレス');
            $table->boolean('is_admin')->default(false)->after('remember_token')->comment('管理者権限 true:管理者');
            $table->boolean('is_approved')->default(false)->after('is_admin')->comment('承認ステータス true:承認済');
            // $table->datetime('created_at')->useCurrent()->comment('作成日時');
            // $table->datetime('updated_at')->useCurrentOnUpdate()->comment('更新日時');
            $table->timestamp('last_login_at')->after('updated_at')->comment('最終ログイン日時');
            $table->softDeletes()->after('last_login_at')->comment('論理削除日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name_kana');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('initial');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('birthday');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nationality');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('introduction_text');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_approved');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_login_at');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
