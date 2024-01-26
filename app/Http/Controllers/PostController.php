<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // use宣言、App\Models内のPostクラスをインポート。
use App\Http\Requests\PostRequest; //バリデーションを使用するためstore関数で使用

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
     * 引数にはユーザーからのバリデーション済みの入力データを扱うため、PostRequestインスタンスを利用する。
     * ユーザーの入力データをDBのpostsテーブルに保存するため、空のPostインスタンスを利用する。
     * 
     * 注意: データを保存するにはPostモデル側でfillableプロパティにfill可能なプロパティを指定しておく必要あり。
     */
    public function store(Post $post, PostRequest $request)
    {
        //HTMLのFormタグ内のname属性（'post'）からリクエストパラメータ（入力内容）を取得する。
        $input = $request['post'];
        //fillableで指定されたfill可能なプロパティを上書きする。$post->create($input);でも同じ挙動になる。
        $post->fill($input)->save();
        //投稿したidのURLにリダイレクトする
        return redirect('/posts/' . $post->id);
     }
     
    /**
     * ブログ編集画面を表示する
     * 
     * @params Object Post
     * @return edit view
     */
     public function edit(Post $post)
     {
         //ブログ編集画面を表示し、$postのデータを渡す
         return view('posts.edit')->with(['post' => $post]);
     }
}
