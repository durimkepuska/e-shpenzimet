<?php
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){

   Route::group(['middleware' => 'guest'], function(){
        // Login
        Route::get('login', ['as' => 'auth.login', 'uses' => 'AuthController@getLogin']);
        Route::post('login', ['as' => 'auth.login.store', 'before' => 'throttle:2,60', 'uses' => 'AuthController@postLoginn']);
   });

   Route::group(['middleware' => ['auth', 'admin']], function(){
        // Register user
        Route::get('register', ['as' => 'auth.register', 'uses' => 'AuthController@getRregister']);
        Route::post('register', ['as' => 'auth.register.store', 'uses' => 'AuthController@postRregister']);
   });

   Route::group(['middleware' => 'auth'], function(){
        // Logout
        Route::get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@getLogoutt']);
   });

});

Route::group(['middleware' => 'guest'], function(){

    // Password reset link request routes...
    Route::get('password/email', 'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmail');

    // Password reset routes...
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset/{token}', 'Auth\PasswordController@postReset');
});

//buxheti
Route::get('home','BudgetController@home');
Route::resource('budget','BudgetController');
Route::post('addbudget' , 'BudgetController@addbudget');

//nen buxheti
Route::resource('sub_budget','SubBudgetController');
Route::post('sub_budgetSearch' , 'SubBudgetController@search');

//sub budget container
Route::resource('sub_budget_container','SubBudgetContainerController');
Route::post('addsub_budget' , 'SubBudgetContainerController@addsub_budget');
Route::get('sub_budget_graph' , 'SubBudgetContainerController@home');


//Shpenzimet
Route::resource('expenditures' , 'ExpenditureController');
Route::get('expendituresDepts' , 'ExpenditureController@depts');
Route::get('expendituresPaid' , 'ExpenditureController@paid');
Route::get('expendituresRaport' , 'ExpenditureController@raport');
Route::post('expendituresRaport' , 'ExpenditureController@generateRaport');
Route::post('expendituresSearch' , 'ExpenditureController@search');

Route::get('expendituresPay/{id}' , 'ExpenditureController@pay');

Route::post('paysomething' , 'ExpenditureController@paysomething');

Route::get('expendituresHidde' , 'ExpenditureController@hidden');
Route::get('expendituresHidde/{id}' , 'ExpenditureController@hidde');

Route::get('expendituresUnHidde/{id}' , 'ExpenditureController@unhidde');


Route::get('expendituresIncompleted' , 'ExpenditureController@incompleted');

Route::get('expendituresNotifications' , 'ExpenditureController@notifications');

//Furnitoret
Route::resource('suppliers' , 'SupplierController');
Route::post('suppliersSearch' , 'SupplierController@search');

//Drejtorite
Route::resource('departments' , 'DepartmentController');
Route::post('departmentsSearch' , 'DepartmentController@search');

//llojet e shpenzimeve
Route::resource('spendingtypes' , 'SpendingtypeController');
Route::post('spendingtypesSearch' , 'SpendingtypeController@search');

//Vijat Buxhetore
Route::resource('payment_sources' , 'PaymentsourceController');
Route::post('payment_sourcesSearch' , 'PaymentsourceController@search');

//Rolet
Route::resource('roles' , 'RoleController');
Route::post('rolesSearch' , 'RoleController@search');

//Rolet
Route::resource('users' , 'UserController');
Route::post('usersSearch' , 'UserController@search');

//Kategorite e shpenzimeve
Route::resource('spending_categories' , 'SpendingCategoryController');
Route::post('spending_categoriesSearch' , 'SpendingCategoryController@search');

//Zotimet

Route::get('zotimet' , 'ExpenditureController@zotimet');
Route::get('zotimet/create' , 'ExpenditureController@zotimet_create');
Route::post('zotimet/store' , 'ExpenditureController@zotimet_store');
Route::get('zotimet/{id}' , 'ExpenditureController@zotimet_show');
Route::get('zotimet/{id}/edit' , 'ExpenditureController@zotimet_edit');
Route::put('azhurozotim/{id}' , 'ExpenditureController@azhurozotim');

//Errors
Route::get('error', function(){
    return view('errors.404');
});

//web
Route::get('/', 'WebController@index');
Route::post('generateRaport', 'WebController@generateRaport');

//send mail
//Route::get('email', 'UserController@sendme');
