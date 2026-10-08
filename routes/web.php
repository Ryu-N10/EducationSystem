<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ProgressController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ユーザー側のルートグループ
Route::prefix('user')->name('user.')->group(function () {
    
    // 【開発用の一時的な代替案】
    // 他のメンバーがトップページを作成するまでの間、エラーを防ぐための仮のルート
    Route::get('/top', function () {
        return 'ここは仮のトップページです。本来は TopController が処理します。';
    })->name('show.top');
    
    // あなたが担当している授業進捗画面
    Route::get('/progress', [ProgressController::class, 'showProgress'])->name('show.progress');
    
});