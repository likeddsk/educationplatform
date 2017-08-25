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
  //后台登陆
  Route::match(['get','post'],'/login','IndexController@login');
  Route::group(['middleware'=>['CheckAdminLogin'] ],function(){
      //后台首页
      Route::get('/index','IndexController@index');
      //后台首页的欢迎页
      Route::get('/welcome','IndexController@welcome');
      //管理员退出
      Route::get('/logout','IndexController@logout');
      //管理员资源路由
      // Route::resource($uri,$controller) $uri路由地址 $controller资源控制器名
      Route::resource('/admin','AdminController');
  });
});
//项目前台
Route::group([],function(){

});
