<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * テーブルを作成するためのupメソッド。
     * $table->データの型('カラム名')の形でカラムを追加していく。
     * 「php artisan migrate」というコマンドでテーブル作成を実行できる。
     * 
     * 注意: もしエラーが発生したり、追加でデータを追加したい場合は新たにマイグレーションファイルを作成するか、
     * ロールバック処理を行う必要がある。このファイル内のエラー内容を修正したとしても、
     * このファイルは既にマイグレーション済みなので反映されない。
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // 自動採番（符号なしint型）のカラムを追加する。
            $table->string('title', 100); // titleという名前の文字列カラムを追加し、第2引数で最大文字数を100文字以下に指定。
            $table->string('body', 4000); // bodyという名前の文字列カラムを追加し、第2引数で最大文字数を4000文字以下に指定。
            $table->timestamps(); // 作成日時カラム（created_at）と更新日時カラム（updated_at）を追加する。
            $table->softDeletes(); // 論理削除処理に必要な削除日時カラム（deleted_at）を追加する。
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
