<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * postsテーブルに外部キー（category_id）のカラムを追加
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            /*
            categoriesテーブルのidを参照する外部キーを追加。
            onDelete('cascade')を設定すると、紐づいているお互いのデータが同時に削除される。
            */
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
};
