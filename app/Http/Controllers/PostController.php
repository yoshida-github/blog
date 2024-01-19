<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // use宣言、App\Models内のPostクラスをインポート。

class PostController extends Controller
{
    /**
     * Post一覧を表示する
     * 
     * @param Post Postモデル
     * @return array Postモデルリスト
    */
    public function index(Post $post) //インポートしたPostをインスタンス化して$postとして使用。
    {
        return $post->get(); //$postの中身を戻り値にする。
    }
}
