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
// frontend routes
Route::get('/', 'Frontend\FrontendController@index');

Auth::routes();

// backend routes
Route::get('/home', 'HomeController@index')->name('home');

// auth middleware to prevent user from accessing dashboard before login
Route::group(['middleware' => 'auth'], function () {
    // route group for user management
    Route::prefix('users')->group(function () {
        Route::get('/view', 'Backend\UserController@view')->name('users.view');
        Route::get('/add', 'Backend\UserController@add')->name('users.add');
        Route::post('/store', 'Backend\UserController@store')->name('users.store');
        Route::get('/edit/{id}', 'Backend\UserController@edit')->name('users.edit');
        Route::post('/update/{id}', 'Backend\UserController@update')->name('users.update');
        Route::get('/delete/{id}', 'Backend\UserController@delete')->name('users.delete');
    });

    // route group for profiles management
    Route::prefix('profiles')->group(function () {
        Route::get('/view', 'Backend\ProfileController@view')->name('profiles.view');
        Route::get('/edit', 'Backend\ProfileController@edit')->name('profiles.edit');
        Route::post('/update', 'Backend\ProfileController@update')->name('profiles.update');
        Route::get('/password/view', 'Backend\ProfileController@passwordView')->name('profiles.password.view');
        Route::post('/password/update', 'Backend\ProfileController@passwordUpdate')->name('profiles.password.update');
    });

    // route group for suppliers management
    Route::prefix('suppliers')->group(function () {
        Route::get('/view', 'Backend\SupplierController@view')->name('suppliers.view');
        Route::get('/add', 'Backend\SupplierController@add')->name('suppliers.add');
        Route::post('/store', 'Backend\SupplierController@store')->name('suppliers.store');
        Route::get('/edit/{id}', 'Backend\SupplierController@edit')->name('suppliers.edit');
        Route::post('/update/{id}', 'Backend\SupplierController@update')->name('suppliers.update');
        Route::get('/delete/{id}', 'Backend\SupplierController@delete')->name('suppliers.delete');
    });

    // route group for customers management
    Route::prefix('customers')->group(function () {
        Route::get('/view', 'Backend\CustomerController@view')->name('customers.view');
        Route::get('/add', 'Backend\CustomerController@add')->name('customers.add');
        Route::post('/store', 'Backend\CustomerController@store')->name('customers.store');
        Route::get('/edit/{id}', 'Backend\CustomerController@edit')->name('customers.edit');
        Route::post('/update/{id}', 'Backend\CustomerController@update')->name('customers.update');
        Route::get('/delete/{id}', 'Backend\CustomerController@delete')->name('customers.delete');
    });

    // route group for units management
    Route::prefix('units')->group(function () {
        Route::get('/view', 'Backend\UnitController@view')->name('units.view');
        Route::get('/add', 'Backend\UnitController@add')->name('units.add');
        Route::post('/store', 'Backend\UnitController@store')->name('units.store');
        Route::get('/edit/{id}', 'Backend\UnitController@edit')->name('units.edit');
        Route::post('/update/{id}', 'Backend\UnitController@update')->name('units.update');
        Route::get('/delete/{id}', 'Backend\UnitController@delete')->name('units.delete');
    });

    // route group for categories management
    Route::prefix('categories')->group(function () {
        Route::get('/view', 'Backend\CategoryController@view')->name('categories.view');
        Route::get('/add', 'Backend\CategoryController@add')->name('categories.add');
        Route::post('/store', 'Backend\CategoryController@store')->name('categories.store');
        Route::get('/edit/{id}', 'Backend\CategoryController@edit')->name('categories.edit');
        Route::post('/update/{id}', 'Backend\CategoryController@update')->name('categories.update');
        Route::get('/delete/{id}', 'Backend\CategoryController@delete')->name('categories.delete');
    });

    // route group for products management
    Route::prefix('products')->group(function () {
        Route::get('/view', 'Backend\ProductController@view')->name('products.view');
        Route::get('/add', 'Backend\ProductController@add')->name('products.add');
        Route::post('/store', 'Backend\ProductController@store')->name('products.store');
        Route::get('/edit/{id}', 'Backend\ProductController@edit')->name('products.edit');
        Route::post('/update/{id}', 'Backend\ProductController@update')->name('products.update');
        Route::get('/delete/{id}', 'Backend\ProductController@delete')->name('products.delete');
    });

    // route group for purchases management
    Route::prefix('purchases')->group(function () {
        Route::get('/view', 'Backend\PurchaseController@view')->name('purchases.view');
        Route::get('/add', 'Backend\PurchaseController@add')->name('purchases.add');
        Route::post('/store', 'Backend\PurchaseController@store')->name('purchases.store');
        Route::get('/pending', 'Backend\PurchaseController@pendingList')->name('purchases.pending.list');
        Route::get('/approve/{id}', 'Backend\PurchaseController@approve')->name('purchases.approve');
        Route::get('/delete/{id}', 'Backend\PurchaseController@delete')->name('purchases.delete');
    });

    // default controller
    Route::get('/get-category', 'Backend\DefaultController@getCategory')->name('get-category');
    Route::get('/get-product', 'Backend\DefaultController@getProduct')->name('get-product');
    Route::get('/get-stock', 'Backend\DefaultController@getStock')->name('check-product-stock');

    // route group for inovices management
    Route::prefix('inovices')->group(function () {
        Route::get('/view', 'Backend\InvoiceController@view')->name('inovices.view');
        Route::get('/add', 'Backend\InvoiceController@add')->name('inovices.add');
        Route::post('/store', 'Backend\InvoiceController@store')->name('inovices.store');
        Route::get('/pending', 'Backend\InvoiceController@pendingList')->name('inovices.pending.list');
        Route::get('/approve/{id}', 'Backend\InvoiceController@approve')->name('inovices.approve');
        Route::get('/delete/{id}', 'Backend\InvoiceController@delete')->name('inovices.delete');
        Route::post('approve/store/{id}', 'Backend\InvoiceController@approvalStore')->name('approval.store');
    });
});
