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

//Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/h', function () {
//    return view('mHome');
//});
Route::get('/home', [
    'uses' => 'HomeController@me',
    'as' => 'home'
])->middleware('auth');
//Route::get('/t', function () {
//    return view('t');
//});
//Route::get('/tt', function () {
//    return view('tt');
//});


// Index Register
Route::post('/MealManagerCreateWithMealSystem', [
    'uses' => 'MealsystemController@store',
    'as' => 'store.mM.mS'
]);

Route::get('/MealMemberCreate', [
    'uses' => 'UserController@create',
    'as' => 'create.user'
])->middleware('auth', 'mM');
Route::post('/MealMemberStore', [
    'uses' => 'UserController@store',
    'as' => 'store.user'
])->middleware('auth', 'mM');

Route::post('/MealMemberUpdate/{slug}', [
    'uses' => 'UserController@update',
    'as' => 'update.user'
])->middleware('auth');

Route::get('/Enter-Edit-Data', [
    'uses' => 'DatamController@create',
    'as' => 'datam.create'
])->middleware('auth', 'mM');
Route::post('/DatamStore/{id}', [
    'uses' => 'DatamController@store',
    'as' => 'store.datam'
])->middleware('auth', 'mM');

Route::get('/Edit-Data/{slug}/{msid}/{m}/{d}', [
    'uses' => 'DatamController@edit',
    'as' => 'datam.t.edit'
])->middleware('auth', 'mM');
Route::post('/DatamUpdate/{did}', [
    'uses' => 'DatamController@update',
    'as' => 'datam.t.update'
])->middleware('auth', 'mM');


Route::get('/old-member-attach/{id}', [
    'uses' => 'UserController@oldma',
    'as' => 'oldm.attach'
])->middleware('auth', 'mM');
Route::post('/old-member-store/{msid}', [
    'uses' => 'UserController@oldMadd',
    'as' => 'old.add'
])->middleware('auth', 'mM');

Route::get('/personal-table/{slug}/{id}', [
    'uses' => 'PtableController@index',
    'as' => 'p.table'
])->middleware('auth');

Route::get('/full-table/{msid}', [
    'uses' => 'PtableController@tt',
    'as' => 'f.table'
])->middleware('auth');

Route::get('home/{msid}/Previous/month', [
    'uses' => 'HomeController@lmonth',
    'as' => 'lhome'
])->middleware('auth');

Route::get('/Enter-Edit-Old-Data/{msid}', [
    'uses' => 'DatamController@pcreate',
    'as' => 'datam.pcreate'
])->middleware('auth', 'mM');
Route::post('/DatamStoreP/{msid}', [
    'uses' => 'DatamController@pstore',
    'as' => 'store.pdatam'
])->middleware('auth', 'mM');

//Route::get('/Edit-Data/{slug}/{msid}/{m}/{d}', [
//    'uses' => 'DatamController@edit',
//    'as' => 'datam.t.edit'
//]);
//Route::post('/DatamUpdate/{did}', [
//    'uses' => 'DatamController@update',
//    'as' => 'datam.t.update'
//]);


// ADMIN
route::get('/sfdssffdgdtfhERFRGsdg', [
    'uses' => 'HomeController@admin',
    'as' => 'admin.delete'
])->middleware('admin');
