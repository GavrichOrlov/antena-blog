<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::any('/', 'HomeController@index')->name('/');

Route::any('/category/{id}', 'HomeController@categoryShowById')->name('/category/{id}');
Route::any('/blogs', 'HomeController@blogs')->name('/blogs');
Route::any('/blog/{id}', 'HomeController@blogById')->name('/blog/{id}');
Route::any('/about', 'HomeController@about')->name('/about');
Route::any('/pagination/{category}/{pagination}', 'HomeController@paginationByCategoryId')->name('/pagination/{category}/{pagination}');
Route::any('/register_out', 'HomeController@register_out')->name('/register_out');

Route::get('/auth/login', function () {
    return view('auth/login');
});

Route::any('logout', 'SearchController@logout')->name('logout');
Route::get('login', 'Auth\AuthController@auth')->name('login');
Route::post('reset', 'Auth\AuthController@password_request')->name('password.request');
Route::post('register', 'Auth\AuthController@show')->name('register.show');
Route::post('register/{id}', 'Auth\AuthController@create')->name('register.create');
Route::group(['middleware' => 'auth'], function() {
    Route::any('dashboard', 'CategoryController@dashboard')->name('dashboard');
    Route::get('/getCategorys/{id}','CategoryController@getCategories')->name('/getCategorys/{id}');
    Route::get('/getCategory_data/{id}','CategoryController@getCategory_data')->name('/getCategory_data/{id}');
    Route::post('category_update','CategoryController@update')->name('category_update');
    Route::post('categorypdate','CategoryController@categoryupdate')->name('categoryupdate');
    Route::any('/delete/{id}','CategoryController@delete')->name('/delete/{id}');

    Route::get('category_show/{id}','CategoryController@category_show')->name('category_show/{id}');
    Route::get('getrssData/{id}','CategoryController@getrssData')->name('getrssData/{id}');
    Route::post('rss_update','CategoryController@rss_update')->name('rss_update');
    Route::any('/rssdelete/{id}','CategoryController@rssdelete')->name('/rssdelete/{id}');

    Route::get('/search', array('as' => '/search','uses' => 'SearchController@getdata'));
    Route::get('users', 'App\Http\Controllers\UsersManagementController@index')->name('users');
    Route::post('users', 'App\Http\Controllers\UsersManagementController@store')->name('users.store');
    Route::get('users/create', 'App\Http\Controllers\UsersManagementController@create')->name('users.create');
    Route::get('users/{user}', 'App\Http\Controllers\UsersManagementController@show')->name('users.show');
    Route::get('users/{destroy}', 'App\Http\Controllers\UsersManagementController@destroy')->name('users.destroy');
    Route::get('users/{update}', 'App\Http\Controllers\UsersManagementController@update')->name('users.update');
    Route::get('users/{user}/edit', 'App\Http\Controllers\UsersManagementController@edit')->name('users.edit');
    Route::post('userupdate','SearchController@userupdate')->name('userupdate');
 //    Route::any('dashboard', 'SearchController@dashboard')->name('dashboard');
 //    Route::get('/getUsers/{id}','SearchController@getUsers')->name('/getUsers/{id}');
 //    Route::get('/getUser_data/{id}','SearchController@getUser_data')->name('/getUser_data/{id}');
 //    Route::post('update','SearchController@update')->name('update');
 //    Route::post('userupdate','SearchController@userupdate')->name('userupdate');
 //    Route::any('/delete/{id}','SearchController@delete')->name('/delete/{id}');
    // Route::get('/search', array('as' => '/search','uses' => 'SearchController@getdata'));
 //    Route::get('users', 'App\Http\Controllers\UsersManagementController@index')->name('users');
 //    Route::post('users', 'App\Http\Controllers\UsersManagementController@store')->name('users.store');
 //    Route::get('users/create', 'App\Http\Controllers\UsersManagementController@create')->name('users.create');
 //    Route::get('users/{user}', 'App\Http\Controllers\UsersManagementController@show')->name('users.show');
 //    Route::get('users/{destroy}', 'App\Http\Controllers\UsersManagementController@destroy')->name('users.destroy');
 //    Route::get('users/{update}', 'App\Http\Controllers\UsersManagementController@update')->name('users.update');
 //    Route::get('users/{user}/edit', 'App\Http\Controllers\UsersManagementController@edit')->name('users.edit');
});

Route::any('signup', 'Auth\AuthController@signup')->name('signup');
Route::any('signin', 'Auth\AuthController@signin')->name('signin');
Route::any('signupcontrol', 'Auth\AuthController@signupcontrol')->name('signupcontrol');
Route::any('signincontrol', 'Auth\AuthController@signincontrol')->name('signincontrol');
