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
    return view('index');
});


Auth::routes();

Route::post('/MealManagerCreateWithMealSystem', [
    'uses' => 'MealsystemController@store',
    'as' => 'store.mM.mS'
]);

Route::get('/home', [
    'uses' => 'HomeController@home',
    'as' => 'home'
])->middleware('auth');

Route::get('/Create-Meal-Member', [
    'uses' => 'UserController@create',
    'as' => 'create.user'
])->middleware('auth', 'mM');
Route::post('/MealMemberStore', [
    'uses' => 'UserController@store',
    'as' => 'store.user'
])->middleware('auth', 'mM');

Route::get('/Edit-Your-Profile/{slug}', [
    'uses' => 'UserController@edit',
    'as' => 'edit.user'
])->middleware('auth');
Route::post('/MealMemberUpdate/{slug}', [
    'uses' => 'UserController@update',
    'as' => 'update.user'
])->middleware('auth');

Route::get('/change-mealmanager', [
    'uses' => 'UserController@mmchange',
    'as' => 'mealmanager.change'
])->middleware('auth', 'mM');
Route::post('/meal-manager/change/store', [
    'uses' => 'UserController@mmchangestore',
    'as' => 'mealmanager.change.store'
])->middleware('auth', 'mM');

Route::get('/Enter-Edit-Meal_Data-or-Expense', [
    'uses' => 'DatamController@create',
    'as' => 'mM.mdata.expense.create'
])->middleware('auth', 'mM');
Route::post('/Enter-Edit-Data-Save/{msid}', [
    'uses' => 'DatamController@store',
    'as' => 'mM.store.mdata'
])->middleware('auth', 'mM');

Route::get('utility', [
    'uses' => 'ExpenseController@index',
    'as' => 'utility'
])->middleware('auth');
//Route::get('create/utility-expense/{msid}', [
//    'uses' => 'ExpenseController@create',
//    'as' => 'create.exp'
//])->middleware('auth', 'mM');
Route::post('store/utility-expense/{msid}', [
    'uses' => 'ExpenseController@store',
    'as' => 'exp.store'
])->middleware('auth', 'mM');

Route::get('/personal-table/{slug}/{msid}', [
    'uses' => 'PtableController@index',
    'as' => 'personal.table'
])->middleware('auth');

Route::get('/full-table/{msid}', [
    'uses' => 'PtableController@fulltable',
    'as' => 'full.table'
])->middleware('auth');

Route::get('/Member-Enter-Edit-Meal_Data-or-Expense', [
    'uses' => 'MemdataController@create',
    'as' => 'member.mdata.expense.create'
])->middleware('auth');
Route::post('/Member-Data-Store/{msid}', [
    'uses' => 'MemdataController@store',
    'as' => 'member.store.mdata'
])->middleware('auth');






























//  OLD Starts




// contact
Route::get('/contact', [
    'uses' => 'MealsystemController@contact',
    'as' => 'contact'
]);

Route::post('/contact/sent', [
    'uses' => 'MealsystemController@contactSent',
    'as' => 'contact.sent'
]);

Route::get('/Edit-Data/{slug}/{msid}/{m}/{d}', [
    'uses' => 'DatamController@edit',
    'as' => 'datam.t.edit'
])->middleware('auth', 'mM');
Route::post('/DatamUpdate/{did}', [
    'uses' => 'DatamController@update',
    'as' => 'datam.t.update'
])->middleware('auth', 'mM');
Route::get('/Datamdelete/{did}', [
    'uses' => 'DatamController@destroy',
    'as' => 'datam.t.delete'
])->middleware('auth', 'mM');


Route::get('/old-member-attach/{id}', [
    'uses' => 'UserController@oldma',
    'as' => 'oldm.attach'
])->middleware('auth', 'mM');
Route::post('/old-member-store/{msid}', [
    'uses' => 'UserController@oldMadd',
    'as' => 'old.add'
])->middleware('auth', 'mM');

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




// ADMIN
route::get('/sfdssffdgdtfhERFRGsdg', [
    'uses' => 'HomeController@admin',
    'as' => 'admin.delete'
])->middleware('admin');

Route::get('/Enter-Data/Member/Past-Month', [
    'uses' => 'MemdataController@Pcreate',
    'as' => 'memdata.p.create'
])->middleware('auth');
Route::post('/Member-DataStore/Past-month/{msid}', [
    'uses' => 'MemdataController@Pstore',
    'as' => 'memdata.Pstore'
])->middleware('auth');


Route::get('/Enter-Edit-Data-Member/{month}', [
    'uses' => 'MemdataController@showmemd',
    'as' => 'show.memd'
])->middleware('auth', 'mM');

Route::get('/Delete-Data-Member/{id}', [
    'uses' => 'MemdataController@destroy',
    'as' => 'memdata.delete'
])->middleware('auth', 'mM');

Route::get('/memdata/store/{id}', [
//    this os npt working as post method
    'uses' => 'MemdataController@saveE',
    'as' => 'memdata.accept'
])->middleware('auth', 'mM');

Route::post('/Edit&Store-MemData/{uid}/{msid}/{m}/{d}', [
    'uses' => 'MemdataController@es',
    'as' => 'memdata.ea'
])->middleware('auth', 'mM');


Route::get('Member/Data/Delete/{id}', [
    'uses' => 'MemdataController@deleteown',
    'as' => 'member.DownD'
])->middleware('auth');
Route::get('/Edit/{uid}/{msid}/{m}/{d}', [
    'uses' => 'MemdataController@esOwn',
    'as' => 'memdata.ea.own'
])->middleware('auth');
Route::post('/update/{uid}/{msid}/{m}/{d}', [
    'uses' => 'MemdataController@upOwn',
    'as' => 'memdata.up.own'
])->middleware('auth');


Route::get('/Edit-Data-as-Member/{uid}/{msid}/{m}/{d}', [
    'uses' => 'MemdataController@dataMemEdit',
    'as' => 'data.mem.edit'
])->middleware('auth');
Route::post('/Update-Data-as-Member/{uid}/{msid}/{m}/{d}', [
    'uses' => 'MemdataController@dataMemUpdate',
    'as' => 'memdata.up.data'
])->middleware('auth');

Route::get('/Delete-Data-as-Member/{uid}/{msid}/{m}/{d}', [
    'uses' => 'MemdataController@dataMemDelete',
    'as' => 'data.mem.delete'
])->middleware('auth');
Route::get('/Delete-Undo-as-Member/{uid}/{msid}/{m}/{d}', [
    'uses' => 'MemdataController@deleteUndo',
    'as' => 'delete.undo'
])->middleware('auth');

Route::get('/accept-delete/{uid}/{msid}/{m}/{d}', [
    'uses' => 'DatamController@ad',
    'as' => 'accept.delete'
])->middleware('auth', 'mM');

Route::get('/reject-delete/{uid}/{msid}/{m}/{d}', [
    'uses' => 'DatamController@rd',
    'as' => 'reject.delete'
])->middleware('auth', 'mM');

Route::get('all-balance/{msid}', [
    'uses' => 'HomeController@allbalance',
    'as' => 'allbalance'
])->middleware('auth', 'mM');



Route::get('past-utility/{pmsid}', [
    'uses' => 'ExpenseController@pindex',
    'as' => 'p.utility'
])->middleware('auth');



Route::get('past-create/utility-expense/{msid}', [
    'uses' => 'ExpenseController@pcreate',
    'as' => 'pcreate.exp'
])->middleware('auth', 'mM');

Route::post('past-store/utility-expense/{month}/{msid}', [
    'uses' => 'ExpenseController@pstore',
    'as' => 'pstore.exp'
])->middleware('auth', 'mM');

Route::get('utility/details/{msid}', [
    'uses' => 'ExpenseController@de',
    'as' => 'details.exps'
])->middleware('auth');

Route::get('exp/delete/{eid}/{msid}', [
    'uses' => 'ExpenseController@destroy',
    'as' => 'exp.delete'
])->middleware('auth', 'mM');

Route::get('expense/edit/{eid}/{msid}/{uid}/{month}/{day}', [
    'uses' => 'ExpenseController@edit',
    'as' => 'exp.edit'
])->middleware('auth', 'mM');

Route::post('expense/update/{eid}/{msid}', [
    'uses' => 'ExpenseController@update',
    'as' => 'exp.update'
])->middleware('auth', 'mM');

Route::get('create/m/utility-expense/{slug}/{msid}', [
    'uses' => 'ExpenseController@Mcreate',
    'as' => 'mcreate.exp'
])->middleware('auth');

//Route::get('past-create/utility-expense/{msid}', [
//    'uses' => 'ExpenseController@pcreate',
//    'as' => 'pcreate.exp'
//])->middleware('auth', 'mM');

Route::post('store/m/utility-expense/{uid}/{msid}', [
    'uses' => 'ExpenseController@Mstore',
    'as' => 'exp.Mstore'
])->middleware('auth');

//Route::post('past-store/utility-expense/{month}/{msid}', [
//    'uses' => 'ExpenseController@pstore',
//    'as' => 'pstore.exp'
//])->middleware('auth', 'mM');

Route::get('exp/m/delete/{eid}', [
    'uses' => 'ExpenseController@Mdestroy',
    'as' => 'exp.Mdelete'
])->middleware('auth');

Route::get('/m-expense/edit/{eid}/{msid}/{month}/{day}', [
    'uses' => 'ExpenseController@Medit',
    'as' => 'expMedit'
])->middleware('auth');

Route::post('expense/m/update/{eid}/{msid}', [
    'uses' => 'ExpenseController@Mupdate',
    'as' => 'exp.Mupdate'
])->middleware('auth');

Route::get('mM/accept/expense/{eid}/{msid}', [
    'uses' => 'ExpenseController@mMAcceptExp',
    'as' => 'mM.accept.exp'
])->middleware('auth', 'mM');

Route::get('create/m/past/utility-expense/{slug}/{msid}', [
    'uses' => 'ExpenseController@MPcreate',
    'as' => 'mpcreate.exp'
])->middleware('auth');

Route::post('store/m/past/utility-expense/{uid}/{msid}/{month}', [
    'uses' => 'ExpenseController@MPstore',
    'as' => 'exp.MPstore'
])->middleware('auth');