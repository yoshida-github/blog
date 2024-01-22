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

// ブログ投稿一覧画面
// '/'にGetリクエストが来たら
Route::get('/', [PostController::class, 'index']);

// ブログ投稿詳細画面
// '/posts/{対象データのID}'にGetリクエストが来たら、PostControllerのshowメソッドを実行する。
Route::get('/posts/{post}', [PostController::class, 'show']);