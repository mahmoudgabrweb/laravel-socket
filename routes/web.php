<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

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

Route::get('countries', function () {
    return Cache::remember('countries.all', 20, function () {
        return \DB::table('cities')->get();
    });
});

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource("activity_log", "Logging\ActivityLogController");


Route::resource("categories", "CategoryController");


Route::get('categories/restore/{id}', "CategoryController@restore");



Route::get("get_redis", function() {
    $visits = Redis::incr("visits");
    echo $visits;
});


Route::get("vue_lesson_1", function() {
    return view("vue_lesson_1");
});


Route::get('component', function () {
    return view("component");
});


