<?php

use Illuminate\Support\Facades\Route;

// 后台
Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->middleware(['auth:web', 'check_timeout'])->group(function () {
    // 控制台
    Route::get('/', function () {
        return redirect()->route('dashboard_home');
    });
    Route::get('home', 'DashboardController@home')->name('dashboard_home');
    Route::get('clear', 'DashboardController@clear')->name('cache_clear');
    // 配置
    Route::group(['prefix' => 'config'], function () {
        Route::get('manage', 'ConfigController@manage')->name('config_manage');
        Route::post('update', 'ConfigController@update')->name('config_update');
        Route::post('upload-image', 'ConfigController@uploadImage')->name('water_mark_upload');
    });
    // 标签
    Route::group(['prefix' => 'article_tag'], function () {
        Route::get('manage', 'ArticleTagController@manage')->name('article_tag_manage');
        Route::post('store', 'ArticleTagController@store')->name('article_tag_store');
        Route::get('edit/{id?}', 'ArticleTagController@edit')->name('article_tag_edit');
        Route::post('update', 'ArticleTagController@update')->name('article_tag_update');
        Route::post('destroy', 'ArticleTagController@destroy')->name('article_tag_destroy');
        Route::get('search', 'ArticleTagController@search')->name('article_tag_search');
    });
    // 栏目
    Route::group(['prefix' => 'category'], function () {
        Route::get('manage', 'CategoryController@manage')->name('category_manage');
        Route::get('create', 'CategoryController@create')->name('category_create');
        Route::post('store', 'CategoryController@store')->name('category_store');
        Route::get('edit/{id}', 'CategoryController@edit')->name('category_edit');
        Route::post('update/{id}', 'CategoryController@update')->name('category_update');
        Route::post('destroy', 'CategoryController@destroy')->name('category_destroy');
    });
    // 菜单
    Route::group(['prefix' => 'nav'], function () {
        Route::get('manage', 'NavController@manage')->name('nav_manage');
        Route::get('create', 'NavController@create')->name('nav_create');
        Route::post('store', 'NavController@store')->name('nav_store');
        Route::get('edit/{id}', 'NavController@edit')->name('nav_edit');
        Route::post('update/{id}', 'NavController@update')->name('nav_update');
        Route::post('destroy', 'NavController@destroy')->name('nav_destroy');
    });
    // 文章
    Route::group(['prefix' => 'article'], function () {
        Route::get('manage', 'ArticleController@manage')->name('article_manage');
        Route::get('create', 'ArticleController@create')->name('article_create');
        Route::post('store', 'ArticleController@store')->name('article_store');
        Route::get('edit/{id}', 'ArticleController@edit')->name('article_edit');
        Route::post('update/{id}', 'ArticleController@update')->name('article_update');
        Route::post('delete', 'ArticleController@delete')->name('article_delete');
        Route::get('trash', 'ArticleController@trash')->name('article_trash');
        Route::post('restore', 'ArticleController@restore')->name('article_restore');
        Route::post('destroy', 'ArticleController@destroy')->name('article_destroy');
        Route::get('top/{id}', 'ArticleController@top')->name('article_top');
        Route::post('upload-image', 'ArticleController@uploadImage')->name('article_image_upload');

    });
    // 单页
    Route::group(['prefix' => 'page'], function () {
        Route::get('manage', 'PageController@manage')->name('page_manage');
        Route::get('create', 'PageController@create')->name('page_create');
        Route::post('store', 'PageController@store')->name('page_store');
        Route::get('edit/{id}', 'PageController@edit')->name('page_edit');
        Route::post('update/{id}', 'PageController@update')->name('page_update');
        Route::post('delete', 'PageController@delete')->name('page_delete');
        Route::get('trash', 'PageController@trash')->name('page_trash');
        Route::post('restore', 'PageController@restore')->name('page_restore');
        Route::post('destroy', 'PageController@destroy')->name('page_destroy');
        Route::get('page/{id}', 'PageController@show')->name('page_show');
    });

    // 操作日志
    Route::group(['prefix' => 'operation_logs'], function () {
        Route::get('manage', 'OperationLogsController@manage')->name('operation_logs_manage');
        Route::post('destroy', 'OperationLogsController@destroy')->name('operation_logs_destroy');
    });

});
