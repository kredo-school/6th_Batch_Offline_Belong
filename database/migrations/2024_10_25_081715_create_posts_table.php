<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();  // 自動インクリメントID
            $table->string('category');  // カテゴリ
            $table->string('title');  // タイトル
            $table->dateTime('date');  // 日付
            $table->dateTime('reservation_due_date');  // 予約期限
            $table->string('place');  // 場所
            $table->integer('planned_number_of_people')->nullable();  // 予定人数
            $table->decimal('participation_fee', 8, 2)->nullable();  // 参加費用
            $table->text('description')->nullable();  // 説明
            $table->string('image')->nullable();  // 画像
            $table->timestamps();  // created_at と updated_at カラム
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
