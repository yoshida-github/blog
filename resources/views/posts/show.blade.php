<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale() )}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Post</title>
        
        <!--フォント-->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    
    <body>
        <!--ブログタイトル-->
        <h1 class="title">
            {{ $post->title }}
        </h1>
        <div class="content">
            <!--ブログ本文-->
            <div class="contnt__post">
                <h3>本文</h3>
                <p class="body">{{ $post->body }}</p>
            </div>
        </div>
        
        <!--フッター-->
        <div class="footer">
            <!--一覧画面に戻るボタン-->
            <a href="/">ブログ一覧に戻る</a>
        </div>
    </body>
</html>