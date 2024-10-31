<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); // 外部キー
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 外部キー
            $table->text('body'); // コメントの内容
            $table->timestamps(); // created_at と updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
