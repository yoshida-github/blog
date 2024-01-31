<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale() )}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>ブログ編集画面</title>
        
        <!--フォント-->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    
    <body>
        <x-app-layout></x-app-layout>
            <x-slot name="header">
                ブログ編集画面
            </x-slot>
            <h1>Blog Name</h1>
            
            <!--フォーム（編集したいデータ（"/posts/$post->id"）にPUTリクエストを行うが、FormタグではサポートされていないのでPOSTリクエストを指定）-->
            <form action="/posts/{{ $post->id }}" method="POST">
                <!--CSRF保護_必須-->
                @csrf
                <!--FormタグでサポートされていないPUTリクエストをBladeディレクティブで定義-->
                @method("PUT")
                
                <!--タイトル入力フォーム-->
                <div class="title">
                    <lavel>
                        タイトル
                        <!--valueにold関数を指定し、old関数の引数に（入力データ, 編集前のデータ）を指定。これにより、もしエラーが発生しても入力データを維持できる-->
                        <input type="text" name="post[title]" placeholder="ここにタイトルを入力して下さい" value="{{ old('post.title', $post->title) }}" />
                    </lavel>
                    <!--エラーメッセージ（$errorsに保存されているエラーメッセージを表示）-->
                    <p class="body__error" style="color: red">{{ $errors->first('post.title') }}</p>
                </div>
                
                <!--本文入力フォーム-->
                <div class="body">
                    <label>
                        本文
                        <!--テキストエリア内に編集前の本文を記述-->
                        <textarea name="post[body]" placeholder="ここに本文を入力して下さい">{{ old('post.body', $post->body) }}</textarea>
                    </label>
                    <!--エラーメッセージ-->
                    <p class="body__error" style="color: red">{{ $errors->first('post.body') }}</p>
                </div>
                
                <!--保存ボタン-->
                <div class="submit">
                    <input type="submit" value="変更内容を保存する" />
                </div>
            </form>
            
            <!--フッター-->
            <div class="footer">
                <a href="/">ホームに戻る</a>
            </div>
        </x-app-layout>
    </body>
</html>