<?php

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

Auth::routes();

Route::resource('/register-user','RegisterUserController',['only' => [
    'index','store']]);
Route::resource('/payment','PaymentController');

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'auth'],function(){
    Route::resource('/dashboard','DashboardController',['only' => [
        'index']]);
    Route::post('/dashboard','DashboardController@checkCode');
    Route::resource('/category','ItemCategoryController',['only' => [
        'index','store','edit','update','destroy']]);
    Route::patch('/category/{$id}','ItemCategoryController@reactivate');
    Route::resource('/item','ItemController',['only' => [
        'index','store','edit','update','destroy']]);
    Route::patch('/item/{$id}','ItemController@reactivate');
    Route::resource('/admin','AdminController',['only' => [
        'index','store','edit','update','destroy']]);
    Route::patch('/admin/{$id}','AdminController@reactivate');
    Route::resource('/collector','CollectorController',['only' => [
        'index','store','edit','update','destroy']]);
    Route::patch('/collector/{$id}','CollectorController@reactivate');   
    Route::resource('/request','RequestController');
});