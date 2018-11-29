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
})->middleware('auth');
//Route::get('/t', function () {
//    return view('t');
//});
Route::get('/tt', function () {
    return view('tt');
});


// meal system
Route::post('/MealManagerCreateWithMealSystem', [
    'uses' => 'MealsystemController@store',
    'as' => 'store.mM.mS'
]);

Route::get('/MealMemberCreate', [
    'uses' => 'UserController@create',
    'as' => 'create.user'
]);
Route::post('/MealMemberStore', [
    'uses' => 'UserController@store',
    'as' => 'store.user'
]);

Route::post('/MealMemberUpdate/{slug}', [
    'uses' => 'UserController@update',
    'as' => 'update.user'
]);

Route::get('/Enter-Edit-Data', [
    'uses' => 'DatamController@create',
    'as' => 'datam.create'
]);
Route::post('/DatamStore/{id}', [
    'uses' => 'DatamController@store',
    'as' => 'store.datam'
]);

Route::get('/personal-table/{slug}/{id}', [
    'uses' => 'PtableController@index',
    'as' => 'p.table'
]);

Route::get('/old-member-attach/{id}', [
    'uses' => 'userController@oldma',
    'as' => 'oldm.attach'
]);