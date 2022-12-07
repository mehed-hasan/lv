<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\WallpaperController;

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



// Route for cat :
Route::get('/catList', 'App\Http\Controllers\CatController@cat_list');
Route::get('/catPage', 'App\Http\Controllers\CatController@cat_page');
Route::get('/editCat/{id}', 'App\Http\Controllers\CatController@cat_edit_page');
Route::post('/addCat', 'App\Http\Controllers\CatController@add_cat');
Route::post('/delCat', 'App\Http\Controllers\CatController@del_cat');
Route::post('/updateCat', 'App\Http\Controllers\CatController@update_cat');

// Route for type :
Route::get('/typeList', "App\Http\Controllers\TypeController@type_list");
Route::get('/typePage', "App\Http\Controllers\TypeController@type_page");
Route::get('/editType/{id}', "App\Http\Controllers\TypeController@type_edit_page");
Route::post('/addType', "App\Http\Controllers\TypeController@add_type");
Route::post('/updateType', 'App\Http\Controllers\TypeController@update_type');
Route::post('/delType', 'App\Http\Controllers\TypeController@delete_type');



// Route for wallpaper 
Route::get('/addWallpaper', function () {
    return view('addWallpaper');
});
Route::get('/', "App\Http\Controllers\WallpaperController@wp_list");
Route::get('/wpPage', "App\Http\Controllers\WallpaperController@wp_page");
Route::get('/editWp/{id}', "App\Http\Controllers\WallpaperController@wp_edit_page");
Route::post('/addWp', "App\Http\Controllers\WallpaperController@add_wp");
Route::post('/updateWp', 'App\Http\Controllers\WallpaperController@update_wp');
Route::post('/delWp', 'App\Http\Controllers\WallpaperController@del_wp');


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

