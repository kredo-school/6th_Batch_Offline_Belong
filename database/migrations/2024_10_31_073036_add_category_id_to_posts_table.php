<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToPostsTable extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('user_id'); // user_id の後に category_id を追加
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null'); // 外部キー制約
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // 外部キー制約を削除
            $table->dropColumn('category_id'); // カラムを削除
        });
    }
}
