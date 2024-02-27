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
            $table->string('reset_password_access_key', 64)->nullable()->after('verify_token')->comment('パスワード再設定キー');
            $table->timestamp('reset_password_expire_at')->nullable()->comment('パスワード再設定キーの有効期限');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('reset_password_access_key');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('reset_password_expire_at');
        });
    }
};
