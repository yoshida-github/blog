<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// シーディングによるデータ挿入を可能にするため追加
use Illuminate\Support\Facades\DB;
// 現在時刻を取得するために追加
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * postテーブルにシーディングによるデータ挿入を行うためのrunメソッド
     * idカラムは自動採番、deleted_atカラムはNULLなので記述しない。
     */
    public function run(): void
    {
        DB::table('posts')->insert([
                'title' => 'テストタイトル',
                'body' => 'テスト本文',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
        ]);
    }
}
