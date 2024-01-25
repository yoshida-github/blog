<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale() )}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>ブログ作成画面</title>
        
        <!--フォント-->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    
    <body>
        <h1>Blog Name</h1>
        
        <!--フォーム（"/posts" に "POSTリクエスト" を行う）-->
        <form action="/posts" method="POST">
            <!--CSRF保護_必須-->
            @csrf
            
            <!--タイトル入力フォーム-->
            <div class="title">
                <lavel>
                    タイトル
                    <!--oldというのはヘルパー関数で引数に指定したユーザーの入力内容を再表示してくれる（この場合、post[title]の内容が再表示される）-->
                    <input type="text" name="post[title]" placeholder="ここにタイトルを入力して下さい。" value="{{ old('post.title') }}" />
                </lavel>
                <!--エラーメッセージ（バリデーションエラーは、$errorsに格納され、View側に返却されているので、それを利用する）-->
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            
            <!--本文入力フォーム-->
            <div class="body">
                <label>
                    本文
                    <!--old関数で引数に指定したpost[body]の内容を再表示する-->
                    <textarea name="post[body]" placeholder="ここに本文を入力して下さい。" value="{{ old('post.body') }}"></textarea>
                </label>
                <!--エラーメッセージ-->
                <p class="body__error" style="color: red">{{ $errors->first('post.body') }}</p>
            </div>
            
            <!--保存ボタン-->
            <div class="submit">
                <input type="submit" value="投稿する" />
            </div>
        </form>
        
        <!--フッター-->
        <div class="footer">
            <a href="/">ホームに戻る</a>
        </div>
    </body>
</html>