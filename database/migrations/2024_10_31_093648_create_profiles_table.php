<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id(); // プロファイルのID
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーID（外部キー）
            $table->integer('age')->nullable(); // 年齢
            $table->string('gender')->nullable(); // 性別
            $table->text('bio')->nullable(); // 自己紹介文
            $table->string('profile_image')->nullable(); // プロファイル画像のパス
            $table->timestamps(); // 作成日時・更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
}
