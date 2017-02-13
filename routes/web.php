<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/',  'PageController@index')->name('view.index');
Route::get('/contact-us',  'PageController@contactUs')->name('view.contact.us');  

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
    Route::get('/', 'AdminController@index')->name('view.admin.dashboard');
   
    // admin routes to add, edit and delete pages
    Route::get('pages', 'PageController@listPages')->name('admin.list.pages');
    Route::get('pages/create', 'PageController@create')->name('admin.create.page');
    Route::post('pages/store', 'PageController@store')->name('admin.store.page');
    Route::get('pages/{id}', 'PageController@edit')->name('admin.edit.page');
});

// Auth routes for register and login
Auth::routes();

// Generic endpoint for all cmsable pages
Route::any('{any}',  'PageController@getPageBySlug')->where('any', '.*')->name('view.cms.page');  



