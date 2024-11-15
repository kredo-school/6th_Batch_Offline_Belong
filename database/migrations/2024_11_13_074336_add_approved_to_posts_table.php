<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // `approved` カラムを enum 型に変更
            $table->unsignedBigInteger('approved')->default(0)->comment("1:approved, 0:not approved");
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // 元に戻す場合（例えば `tinyInteger`）
            $table->tinyInteger('approved')->default(0);
        });
    }


};
