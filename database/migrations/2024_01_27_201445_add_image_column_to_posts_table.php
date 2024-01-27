<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * postsテーブルにimageカラムを追加するためのマイグレーションファイル
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('image', 100)->nullable(); // imageという名前で100文字以下の文字列カラムを追加して、NULL値を許可する。
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
