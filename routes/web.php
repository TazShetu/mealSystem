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

Route::get('/test', function () {
    dd(\Carbon\Carbon::now()->month);
});


Route::get('/', function () {
    return view('mWelcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/h', function () {
    return view('mHome');
});
Route::get('/hh', function () {
    return view('mmHome');
});
Route::get('/t', function () {
    return view('t');
});
Route::get('/tt', function () {
    return view('tt');
});


// meal system
Route::post('/MealManagerCreateWithMealSystem', [
    'uses' => 'MealsystemController@store',
    'as' => 'store.mM.mS'
]);
