<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// namespaceの中身をフルパス(App\Http\Controllers\User)に修正しています
Route::prefix('user')->namespace('App\Http\Controllers\User')->name('user.')->group(function () {
    Route::get('/article/{id}', 'ArticleController@showArticle')->name('show.article');
});