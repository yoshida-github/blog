<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController; //PostControllerをインポート
use App\Http\Controllers\CategoryController; // CategoryControllerをインポート

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// PostControllerルーティンググループ（認証機能付き）
Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    // ブログ投稿一覧画面を表示
    Route::get('/', 'index')->name('index');
    //ブログを投稿する
    Route::post('/posts', 'store')->name('store');
    //プログ作成画面を表示
    Route::get('/posts/create', 'create')->name('create');
    //ブログ詳細画面を表示
    Route::get('/posts/{post}', 'show')->name('show');
    //ブログ編集を実行する
    Route::put('/posts/{post}', 'update')->name('update');
    //ブログ削除を実行する
    Route::delete('/posts/{post}', 'delete')->name('delete');
    //ブログ編集画面を表示
    Route::get('/posts/{post}/edit', 'edit')->name('edit');
});

// CategoryControllerルーティンググループ
Route::controller(CategoryController::class)->middleware(['auth'])->group(function(){
    Route::get('/categories/{category}', 'index');
});

require __DIR__.'/auth.php';
