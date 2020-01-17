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

Route::get('/', 'IndexController@index');

//Route::any('message',function (){
//    return view('welcome');
//});

/*
 * 后台路由群
 */
Route::match(['get','post'],'admin/login','admin\LoginController@login')->name('login');

Route::namespace('admin')->middleware('admin')->prefix('admin')->group(function (){

    Route::get('exit_login','IndexController@exit_login');//退出登录

    Route::get('index','IndexController@index');//首页
    Route::get('welcome','IndexController@welcome')->name('welcome');//子页

    Route::get('rule_list','SiteController@rule_list');//规则列表
    Route::get('add_rule','SiteController@add_rule');//添加规则
    Route::match(['get','post'],'auth_rule_edit/{id?}','SiteController@auth_rule_edit');//编辑规则
    Route::get('auth_rule_drop','SiteController@auth_rule_drop');//删除规则

    Route::get('auth_group','SiteController@auth_group');//分组名称
    Route::match(['get','post'],'auth_group_edit/{id?}','SiteController@auth_group_edit');//分组编辑
    Route::get('auth_group_drop','SiteController@auth_group_drop');//删除编辑

    Route::get('group_list','SiteController@group_list');//角色列表
    Route::match(['get','post'],'add_group','SiteController@add_group');//角色添加
    Route::match(['get','post'],'edit_group/{id?}','SiteController@edit_group');//角色编辑
    Route::get('drop_group','SiteController@drop_group');//角色编辑

    Route::get('admin_list','SiteController@admin_list');//管理后台
    Route::match(['get','post'],'add_admin','SiteController@add_admin');//添加管理
    Route::match(['get','post'],'edit_admin/{id?}','SiteController@edit_admin');//编辑管理
    Route::get('drop_admin','SiteController@drop_admin');//删除管理

    Route::get('log_list','IndexController@log_list');//管理日志
    Route::get('log_drop','IndexController@log_drop');//管理日志

});

Route::any('/message',function (){
   return view('message',['data'=>\Illuminate\Support\Facades\Request::input('data')]);
})->name('message');

