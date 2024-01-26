<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; //外部にあるPostControllerクラスをインポート

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * 注意:
 * web.phpは上から順番にルーティングを見ていき、当てはまるルーティングが呼び出される。
 * 具体的には、ブログ作成画面よりも先にブログ詳細画面のルーティングを書くと、
 * {post}にcreateという文字列が入ってしまい、
 * showメソッドが呼び出されるという予期しない挙動になる。
 */

// ブログ投稿一覧画面
// '/'にGetリクエストが来たら
Route::get('/', [PostController::class, 'index']);

// ブログ作成画面を表示
Route::get('/posts/create', [PostController::class, 'create']);

// ブログ投稿詳細画面
// '/posts/{対象データのID}'にGetリクエストが来たら、PostControllerのshowメソッドを実行する。
Route::get('/posts/{post}', [PostController::class, 'show']);

//ブログを投稿するボタンをクリックした際のPOSTリクエストを実行する
Route::post('/posts', [PostController::class, 'store']);

// ブログ編集画面を表示（{post}は編集したいブログ記事のid）
Route::get('/posts/{post}/edit', [PostController::class, 'edit']);