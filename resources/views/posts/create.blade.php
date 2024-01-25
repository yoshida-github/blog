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
        
        <!--フォーム-->
        <form action="/posts" method="POST">
            <!--CSRF保護_必須-->
            @csrf
            
            <!--タイトル入力フォーム-->
            <div class="title">
                <lavel>
                    タイトル
                    <input type="text" name="post[title]" placeholder="ここにタイトルを入力して下さい。" />
                </lavel>
            </div>
            
            <!--本文入力フォーム-->
            <div class="body">
                <label>
                    本文
                    <textarea name="post[body]" placeholder="ここに本文を入力して下さい。"></textarea>
                </label>
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