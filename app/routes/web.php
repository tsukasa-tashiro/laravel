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


Route::get('/', 'HomeController@index')->name('home');
Route::get('/post/search','PostController@search')->name('post.search');
Route::get('/account','DisplayController@account');

Route::post('/post/confirm', 'PostController@confirm')->name('post.confirm');
Route::post('/camera/confirm', 'CameraController@confirm')->name('camera.confirm');
Route::post('/lens/confirm', 'LensController@confirm')->name('lens.confirm');
Route::post('/like', 'PostController@like')->name('post.like');

Route::post('/post/editConfirm', 'PostController@editConfirm')->name('post.editConfirm');
Route::post('/camera/editConfirm', 'CameraController@editConfirm')->name('camera.editConfirm');
Route::post('/lens/editConfirm', 'LensController@editConfirm')->name('lens.editConfirm');

Route::resource('post', PostController::class);
Route::resource('camera', CameraController::class);
Route::resource('lens', LensController::class);

});

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
