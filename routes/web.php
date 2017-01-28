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

// static home route
Route::get('/home', 'HomeController@index');

// Auth routes for register and login
Auth::routes();

// Generic endpoint for all cmsable pages
Route::any('{any}',  'PageController@getPageBySlug')->where('any', '.*')->name('view.cms.page');  



