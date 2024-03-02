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
        Schema::create('supports', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->comment('氏名');
            $table->string('email')->nullable(false)->comment('メールアドレス');
            $table->string('message', 400)->nullable(false)->comment('本文');
            $table->timestamps();
            $table->softDeletes()->comment('論理削除日時');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supports');
    }
};
