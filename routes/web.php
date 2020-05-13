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

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware'=> 'auth'],function(){
    Route::get('/search', 'HomeController@searchFlowers');
    Route::delete('/{flowers}', 'HomeController@destroyFlowers')->name('/destroy');

    Route::group(['middleware'=> 'admin'],function(){
        Route::get('/manageflowertypes', 'ManageFlowerTypeController@indexFlowerTypes')->name('manageflowertypes');
        Route::get('/manageflowertypes/create', 'ManageFlowerTypeController@createFlowerTypes')->name('manageflowertypes/create');
        Route::post('/manageflowertypes/store', 'ManageFlowerTypeController@storeFlowerTypes')->name('manageflowertypes/store');
        Route::delete('/manageflowertypes/{flowertypes}', 'ManageFlowerTypeController@destroyFlowerTypes')->name('manageflowertypes/destroy');
        Route::get('/manageflowertypes/{typeid}/edit', 'ManageFlowerTypeController@editFlowerTypes')->name('manageflowertypes/edit');
        Route::put('/manageflowertypes/{typeid}/update', 'ManageFlowerTypeController@updateFlowerTypes')->name('manageflowertypes/update');
        Route::get('manageflowertypes/search', 'ManageFlowerTypeController@searchFlowerTypes');

        Route::get('/manageflowers', 'ManageFlowerController@indexFlowers')->name('manageflowers');
        Route::get('/manageflowers/create', 'ManageFlowerController@createFlowers')->name('manageflowers/create');
        Route::post('/manageflowers/store', 'ManageFlowerController@storeFlowers')->name('manageflowers/store');
        Route::delete('/manageflowers/{flowers}', 'ManageFlowerController@destroyFlowers')->name('manageflowers/destroy');
        Route::get('/manageflowers/{flowerid}/edit', 'ManageFlowerController@editFlowers')->name('manageflowers/edit');
        Route::put('/manageflowers/{flowerid}/update', 'ManageFlowerController@updateFlowers')->name('manageflowers/update');
        Route::get('manageflowers/search', 'ManageFlowerController@searchFlowers');
        
        Route::get('/managecouriers', 'ManageCourierController@indexCouriers')->name('managecouriers');
        Route::get('/managecouriers/create', 'ManageCourierController@createCouriers')->name('managecouriers/create');
        Route::post('/managecouriers/store', 'ManageCourierController@storeCouriers')->name('managecouriers/store');
        Route::get('/managecouriers/{courierid}/edit', 'ManageCourierController@editCouriers')->name('managecouriers/edit');
        Route::put('/managecouriers/{courierid}/update', 'ManageCourierController@updateCouriers')->name('managecouriers/update');
        Route::delete('/managecouriers/{couriers}', 'ManageCourierController@destroyCouriers')->name('managecouriers/destroy');
        Route::get('managecouriers/search', 'ManageCourierController@searchCouriers');
        
        Route::get('/manageusers', 'ManageUserController@indexUsers')->name('manageusers');
        Route::delete('/manageusers/{user}', 'ManageUserController@destroyUser')->name('manageusers/destroy');
        Route::get('/manageusers/{id}/edit', 'ManageUserController@editUser')->name('manageusers/edit');
        Route::put('/manageusers/{id}/update', 'ManageUserController@updateUser')->name('updateUser');

        Route::get('/transactionhistory', 'TransactionController@indexHistory')->name('transactionhistory');
    });

    Route::group(['middleware'=> 'member'],function(){
        Route::get('/catalog/{flowerid}/detail', 'CatalogController@detailFlowers')->name('catalog/detail');
        Route::put('/catalog/{flowerid}/insert', 'CatalogController@insertCarts')->name('catalog/insert');
        Route::put('/catalog/{flowers}', 'CatalogController@addCarts')->name('catalog/add');

        Route::get('/cart', 'CartController@indexCarts')->name('cart');
        Route::delete('/cart/{flowers}', 'CartController@destroyCarts')->name('cart/destroy');
        Route::post('/cart/checkout', 'CartController@checkoutCarts')->name('cart/checkout');
    });
    
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile/{id}', 'ProfileController@update')->name('updateProfile');
});