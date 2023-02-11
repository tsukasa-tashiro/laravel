<?php

use App\Http\controllers\DisplayController;
use Illuminate\Support\Facades\Route;

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
Auth::routes();
Route::group(['middleware' => 'auth'],function(){

Route::get('/', function () {
    return view('home');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('search','DisplayController@search');
Route::get('detail','DisplayController@detail');
Route::get('account','DisplayController@account');
// Route::get('add_post','DisplayController@add_post');
Route::get('camera_add','DisplayController@camera_add');
Route::get('lens_add','DisplayController@lens_add');

// 画像投稿
// Route::get('/create', [DisplayController::class, 'create'])->name('post.create');
// Route::post('/store', [DisplayController::class, 'store'])->name('post.store');

Route::post('/post/confirm', 'PostController@confirm')->name('post.confirm');
Route::resource('post', PostController::class);

});

// Route::get('/',[DisplayController::class,'index']);
