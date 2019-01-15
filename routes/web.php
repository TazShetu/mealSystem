<?php

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

Route::get('/Usage', [
    'uses' => 'MealsystemController@usage',
    'as' => 'usage'
]);
Route::get('/How-To-Use', [
    'uses' => 'MealsystemController@usageAuth',
    'as' => 'usageAuth'
])->middleware('auth');

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

Route::post('store/member/utility-expense/{uid}/{msid}', [
    'uses' => 'ExpenseController@MemberStore',
    'as' => 'exp.member.store'
])->middleware('auth');

Route::get('/Accept-Edit-Reject-Given-Data/{msid}', [
    'uses' => 'PtableController@givenTable',
    'as' => 'given.table'
])->middleware('auth', 'mM');

Route::get('/Datamdelete/{did}', [
    'uses' => 'DatamController@destroy',
    'as' => 'datam.delete'
])->middleware('auth', 'mM');

Route::get('/Delete-Data-Member/{did}', [
    'uses' => 'MemdataController@destroy',
    'as' => 'memdata.delete'
])->middleware('auth', 'mM');

Route::get('exp/delete/{eid}', [
    'uses' => 'ExpenseController@destroy',
    'as' => 'exp.delete'
])->middleware('auth', 'mM');

Route::get('exp/delete-unaccepted/{eid}', [
    'uses' => 'ExpenseController@destroyUnaccepted',
    'as' => 'exp.delete.unaccepted'
])->middleware('auth', 'mM');

Route::get('/Delete-Data-as-Member/{did}', [
    'uses' => 'MemdataController@datamDeleteMember',
    'as' => 'datam.delete.member'
])->middleware('auth');

Route::get('/Delete-Undo-as-Member/{uid}/{msid}/{m}/{d}', [
    'uses' => 'MemdataController@datamDeleteMemberUndo',
    'as' => 'datam.delete.member.undo'
])->middleware('auth');

Route::get('Member/Data/Delete/{did}', [
    'uses' => 'MemdataController@memdataDeleteMember',
    'as' => 'memdata.delete.member'
])->middleware('auth');

Route::get('exp/m/delete/{eid}', [
    'uses' => 'ExpenseController@destroyMember',
    'as' => 'exp.member.delete'
])->middleware('auth');

Route::get('/accept-delete/{did}', [
    'uses' => 'DatamController@acceptDelete',
    'as' => 'accept.delete'
])->middleware('auth', 'mM');

Route::get('/reject-delete/{did}', [
    'uses' => 'DatamController@rejectDelete',
    'as' => 'reject.delete'
])->middleware('auth', 'mM');

Route::get('/Edit-Data-Mealmanager-Personal-Table/{slug}/{msid}/{m}/{d}', [
    'uses' => 'DatamController@edit',
    'as' => 'datam.mM.edit'
])->middleware('auth', 'mM');
Route::post('/DatamUpdate/{did}', [
    'uses' => 'DatamController@update',
    'as' => 'datam.mM.update'
])->middleware('auth', 'mM');

Route::get('/Edit-Data-Mealmanager-Given-Table/{slug}/{msid}/{m}/{d}', [
    'uses' => 'DatamController@editGiven',
    'as' => 'datam.mM.edit.given'
])->middleware('auth', 'mM');
Route::post('/DatamUpdate/{uid}/{msid}/{m}/{d}', [
    'uses' => 'DatamController@updateGiven',
    'as' => 'datam.mM.update.given'
])->middleware('auth', 'mM');

Route::get('Edit-Expense/{eid}', [
    'uses' => 'ExpenseController@edit',
    'as' => 'exp.edit'
])->middleware('auth', 'mM');
Route::post('expense/update/{eid}', [
    'uses' => 'ExpenseController@update',
    'as' => 'exp.update'
])->middleware('auth', 'mM');

Route::get('/Edit-Data-As-Member/{did}', [
    'uses' => 'MemdataController@dataMemEdit',
    'as' => 'datam.member.edit'
])->middleware('auth');
Route::post('/Update-Data-as-Member/{did}', [
    'uses' => 'MemdataController@dataMemUpdate',
    'as' => 'datam.member.update'
])->middleware('auth');

Route::get('/Edit-Data-Personal-Table/{did}', [
    'uses' => 'MemdataController@editGivenMember',
    'as' => 'datam.member.edit.given'
])->middleware('auth');
Route::post('/Update-Data-Personal-Table/{did}', [
    'uses' => 'MemdataController@updateGivenMember',
    'as' => 'datam.member.update.given'
])->middleware('auth');

Route::get('/Edit-Expense-As-Member/{eid}', [
    'uses' => 'ExpenseController@MemberEdit',
    'as' => 'exp.member.edit'
])->middleware('auth');
Route::post('Update-Expense-As-Member/{eid}', [
    'uses' => 'ExpenseController@MemberUpdate',
    'as' => 'exp.member.update'
])->middleware('auth');

Route::get('/memdata/store/{did}', [
    'uses' => 'MemdataController@memberDataAccept',
    'as' => 'member.data.accept'
])->middleware('auth', 'mM');

Route::get('mM/accept/expense/{eid}', [
    'uses' => 'ExpenseController@mMAcceptExp',
    'as' => 'mM.accept.exp'
])->middleware('auth', 'mM');




















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

Route::get('/Enter-Data/Member/Past-Month', [
    'uses' => 'MemdataController@Pcreate',
    'as' => 'memdata.p.create'
])->middleware('auth');
Route::post('/Member-DataStore/Past-month/{msid}', [
    'uses' => 'MemdataController@Pstore',
    'as' => 'memdata.Pstore'
])->middleware('auth');

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

Route::get('create/m/past/utility-expense/{slug}/{msid}', [
    'uses' => 'ExpenseController@MPcreate',
    'as' => 'mpcreate.exp'
])->middleware('auth');

Route::post('store/m/past/utility-expense/{uid}/{msid}/{month}', [
    'uses' => 'ExpenseController@MPstore',
    'as' => 'exp.MPstore'
])->middleware('auth');


// ADMIN
route::get('/sfdssffdgdtfhERFRGsdg', [
    'uses' => 'HomeController@admin',
    'as' => 'admin.delete'
])->middleware('admin');