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
     
    /**
     * ブログを投稿する
     * 
     * @params Object Request, Post
     * @return redirect ('/posts/' . $post->id)
     * 
     * 引数にはユーザーからのリクエストに含まれるデータを扱うため、Requestインスタンスを利用する。
     * ユーザーの入力データをDBのpostsテーブルに保存するため、空のPostインスタンスを利用する。
     */
    public function store(Request $request, Post $post)
    {
        //HTMLのFormタグ内のname属性（'post'）からリクエストパラメータ（入力内容）を取得する。
        $input = $request['post'];
        /**
        * fillメソッドで空のPostインスタンスのプロパティを受け取ったキーごとに上書きする。
        * もし、fillを使用しない場合
        * $post->title = $input["title"];
        * $post->body = $input["body"];
        * $post->save();
        * という記述になる。
        * saveはMySQLのINSERT文が実行される。
        * 
        * 注意: fillを使用するにはPostモデル側でfillableプロパティにfill可能なプロパティを指定しておく必要あり。
        */
        
        // $post->create($input)でも同じ挙動になる
        $post->fill($input)->save();
        
        //投稿したidのURLにリダイレクトする
        return redirect('/posts/' . $post->id);
     }
}
