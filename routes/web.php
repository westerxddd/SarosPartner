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
    Route::post('/clients/{client}/count-points', 'ClientController@countPoints')->name('clients.count-points');

    /*** DATA ***/
    Route::get('/data/clients', 'DataController@clients')->name('data.clients');
    Route::get('/data/articles', 'DataController@clientArticles')->name('data.articles');

    /*** USERS ***/
    Route::post('/users/invitation', 'UserController@sendInvitation')->name('users.invite');

    /*** ADMIN ***/
    Route::post('/admin/register', 'AdminController@register')->name('admin.register');

    /*** DEALS ***/
    Route::get('/deals','DealController@index')->name('deals');
    Route::get('/deals/{deal}','DealController@edit')->name('deals.edit');
    Route::post('/deals/store','DealController@store')->name('deals.store');
    Route::patch('/deals/{deal}', 'DealController@store')->name('deals.update');
    Route::delete('/deals/{deal}', 'DealController@delete')->name('deals.delete');

    /*** SITES ***/
    Route::get('/contact-form','SiteController@contactForm')->name('contact-form');
    Route::post('/contact-form/send','SiteController@sendMsg')->name('send-msg');
    Route::get('/settings','SiteController@settings')->name('settings');

    /*** SETTINGS ***/
    Route::post('/setings/change-settings','SettingsController@changeSettings')->name('change-settings');

    /*** ANNOUNCEMENTS ***/
    Route::get('/announcements','AnnouncementController@index')->name('announcements');
    Route::get('/announcements/{announcement}','AnnouncementController@edit')->name('announcements.edit');
    Route::post('/announcements/store','AnnouncementController@store')->name('announcements.store');
    Route::patch('/announcements/{announcement}', 'AnnouncementController@store')->name('announcements.update');
    Route::delete('/announcements/{announcement}', 'AnnouncementController@delete')->name('announcements.delete');
});

Route::get('/register/{token}', 'UserController@registration')->name('users.register');
Route::post('/register/{user}', 'UserController@store')->name('users.store');

