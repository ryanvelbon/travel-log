<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // City
    Route::delete('cities/destroy', 'CityController@massDestroy')->name('cities.massDestroy');
    Route::post('cities/parse-csv-import', 'CityController@parseCsvImport')->name('cities.parseCsvImport');
    Route::post('cities/process-csv-import', 'CityController@processCsvImport')->name('cities.processCsvImport');
    Route::resource('cities', 'CityController');

    // Trip
    Route::delete('trips/destroy', 'TripController@massDestroy')->name('trips.massDestroy');
    Route::post('trips/parse-csv-import', 'TripController@parseCsvImport')->name('trips.parseCsvImport');
    Route::post('trips/process-csv-import', 'TripController@processCsvImport')->name('trips.processCsvImport');
    Route::resource('trips', 'TripController');

    // Expense
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::post('expenses/parse-csv-import', 'ExpenseController@parseCsvImport')->name('expenses.parseCsvImport');
    Route::post('expenses/process-csv-import', 'ExpenseController@processCsvImport')->name('expenses.processCsvImport');
    Route::resource('expenses', 'ExpenseController');

    // Plan
    Route::delete('plans/destroy', 'PlanController@massDestroy')->name('plans.massDestroy');
    Route::post('plans/parse-csv-import', 'PlanController@parseCsvImport')->name('plans.parseCsvImport');
    Route::post('plans/process-csv-import', 'PlanController@processCsvImport')->name('plans.processCsvImport');
    Route::resource('plans', 'PlanController');

    // Tip
    Route::delete('tips/destroy', 'TipController@massDestroy')->name('tips.massDestroy');
    Route::post('tips/parse-csv-import', 'TipController@parseCsvImport')->name('tips.parseCsvImport');
    Route::post('tips/process-csv-import', 'TipController@processCsvImport')->name('tips.processCsvImport');
    Route::resource('tips', 'TipController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
