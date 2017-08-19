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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
//项目后台
Route::group([
  'prefix'    => 'admin',
  'namespace' => 'Back'
],function(){
  //后台首页
  Route::get('/index','IndexController@index');
  Route::get('/welcome','IndexController@welcome');
  Route::get('/login','IndexController@login');
});
//项目前台
Route::group([],function(){

});
