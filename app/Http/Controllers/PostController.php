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
        // blade内で使う変数'posts'と設定。'posts'の中身にgetPaginateByLimitを使い、インスタンス化した$postを代入。
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    
    /**
     * 特定IDのpostを表示する
     * 
     * @params Object Post /／引数の＄postはid=1のPostインスタンス
     * @return Responses post view
     */
     public function show(Post $post)
     {
         // 'post'はbladeファイルで使う変数。中身は$postはid=1のPostインスタンス。
         return view('posts.show')->with(['post' => $post]);
     }
     
    /**
     * ブログ作成画面を表示する
     * 
     * @return Responses create view
     */
     public function create()
     {
        //  ブログ作成画面を表示する
         return view('posts.create');
     }
}
