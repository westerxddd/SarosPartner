<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('dashboard');

Route::group([
    'middleware' => ['auth'],
], function () {
    /*** IMPORT ***/
    Route::get('/import', 'ImportController@import')->name('import');
    Route::post('/import/store', 'ImportController@store')->name('import.store');

    /*** CLIENTS ***/
    Route::get('/clients/{client}', 'ClientController@show')->name('clients.show');

    /*** DATA ***/
    Route::get('/data/clients', 'DataController@clients')->name('data.clients');
    Route::get('/data/articles', 'DataController@clientArticles')->name('data.articles');

    /*** USERS ***/
    Route::post('/users/invitation', 'UserController@sendInvitation')->name('users.invite');

    /*** ADMIN ***/
    Route::post('/admin/register', 'AdminController@register')->name('admin.register');

    /*** DEALS ***/
    Route::get('/deals','DealController@index')->name('deals');
    Route::post('/deals/store','DealController@store')->name('deals.store');

    /*** ANNOUNCEMENTS ***/
    Route::get('/announcements','AnnouncementController@index')->name('announcements');
    Route::post('/announcements/store','AnnouncementController@store')->name('announcements.store');

});

Route::get('/register/{token}', 'UserController@registration')->name('users.register');
Route::post('/register/{user}', 'UserController@store')->name('users.store');

