<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // use宣言、App\Models内のPostクラスをインポート。
use App\Http\Requests\PostRequest; // バリデーションを使用するためstore関数で使用
use App\Models\Category; // カテゴリーを使用するため

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
        // GuzzleHttpを用いてクライアントインスタンス生成
        $client = new \GuzzleHttp\Client();
        // GETリクエストで最新の質問データを取得するためのURL
        $url = 'https://teratail.com/api/v1/questions';
        
        // GETリクエスト送信と返却データの取得（Bearerトークンにアクセストークンを指定して認証を行う）
        $response = $client->request(
            'GET',
            $url,
            ['Bearer' => config('services.teratail.token')]
        );
        
        // API通信で取得したデータはjson形式なのでPHPファイルに対応した連想配列にデコードする
        $questions = json_decode($response->getBody(), true);
        
        // blade内で使う変数'posts'と設定。'posts'の中身にgetPaginateByLimitを使い、インスタンス化した$postを代入。
        // TeratailAPIから取得した質問一覧データをindex.blade.phpに$questionsとして渡す
        return view('posts.index')->with([
            'posts' => $post->getPaginateByLimit(),
            'questions' => $questions['questions'],
        ]);
    }
    
    /**
     * 特定IDのpostを表示する
     * 
     * @params Object Post /／引数の＄postはリクエストされたidのPostインスタンス
     * @return Responses post view
     */
     public function show(Post $post)
     {
        // 'post'はbladeファイルで使う変数。中身は$postはリクエストされたidのPostインスタンス。
        return view('posts.show')->with(['post' => $post]);
     }
     
    /**
     * ブログ作成画面を表示する
     * 
     * @params Object Category
     * @return Responses create view
     */
    public function create(Category $category)
    {
        //  ブログ作成画面を表示する。withメソッドでカテゴリー名を全て取得
        return view('posts.create')->with(['categories' => $category->get()]);
    }
     
    /**
     * ブログを投稿する
     * 
     * @params Object Request, Post
     * @return redirect ('/posts/' . $post->id)
     * 
     * バリデーション済みの入力データを扱うため、PostRequestインスタンスを利用する。
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
     
     /**
      * ブログ編集を実行する
      * 
      * @params Object PostRequest, Post
      * @return redirect ('/posts/' . $post->id)
      */
      public function update(PostRequest $request, Post $post)
      {
          //バリデーション済み入力データ
          $input_post = $request['post'];
          //入力データを保存（差分のみ）
          $post->fill($input_post)->save();
          
          //編集済みブログ詳細画面にリダイレクトする。
          return redirect('/posts/' . $post->id);
      }
      
      /**
       * ブログ削除を実行する
       * 
       * @params Object Post
       * @return redirect '/'
       */
       public function delete(Post $post)
       {
           // Modelクラスに用意されているdelete関数を利用する。
           $post->delete();
           // 一覧画面にリダイレクト
           return redirect('/');
       }
}
