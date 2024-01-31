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
        <!--親ビューを継承-->
        <x-app-layout>
            <!--ヘッダーを表示-->
            <x-slot name="header">
                ブログ一覧
            </x-slot>
            
            <a href="/posts/create">ブログを作成する</a>
            <h1>Blog Name</h1>
            
            <div class="posts">
                <!--ブログ投稿一覧を展開して表示-->
                @foreach ($posts as $post)
                    <div class="post">
                            <h2 class="title">
                                <!--各投稿へのリンクとしてタイトルを表示-->
                                <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                            </h2>
                        <p class="body">{{ $post->body }}</p>
                        
                        <!--カテゴリー名-->
                        <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                        
                        <!--ブログ削除ボタンForm-->
                        <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="POST">
                            <!--csrf保護-->
                            @csrf
                            <!--DLETEリクエストを指定-->
                            @method('DELETE')
                            <!--ブログ削除実行ボタン-->
                            <button type="button" onclick="deletePost({{ $post->id }})" style="color: red">ブログを削除する</button>
                        </form>
                    </div>
                @endforeach
            </div>
            <!--ページネーションリンク-->
            <div class="paginate">{{ $posts->links() }}</div>
            <p>ログインユーザー : {{ Auth::user()->name }}</p>
        </x-app-layout>
        <!--JavaScript-->
        <script>
            /**
             * ブログ削除確認ダイアログを表示する
             * 
             * @params id
             */
            function deletePost(id) {
                'use strict'
                
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>