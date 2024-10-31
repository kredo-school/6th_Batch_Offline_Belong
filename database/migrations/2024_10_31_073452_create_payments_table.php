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
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // 支払いのID
           $table->unsignedBigInteger('user_id'); // ユーザーID（外部キー）
            $table->string('card_number'); // カード番号
            $table->string('expiry_month'); // 有効期限（月）
            $table->string('expiry_year'); // 有効期限（年）
            $table->string('cvv'); // CVVコード
            $table->string('name'); // カード名義人
            $table->timestamps(); // 作成日時・更新日時

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
