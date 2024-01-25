<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale() )}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Blog</title>
        
        <!--フォント-->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    
    <body>
        <a href='/posts/create'>ブログを作成する</a>
        <h1>Blog Name</h1>
        <div class='posts'>
            <!--ブログ投稿一覧を展開して表示-->
            @foreach ($posts as $post)
                <div class='post'>
                        <h2 class='title'>
                            <!--各投稿へのリンクとしてタイトルを表示-->
                            <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        </h2>
                    <p class='body'>{{ $post->body }}</p>
                </div>
            @endforeach
        </div>
        <!--ページネーションリンク-->
        <div class='paginate'>{{ $posts->links() }}</div>
    </body>
</html>