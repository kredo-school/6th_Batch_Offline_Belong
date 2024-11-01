<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // カテゴリーのID
            $table->string('name'); // カテゴリー名
            $table->timestamps(); // created_at と updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}

