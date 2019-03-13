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

/*
Route::get('/', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('pages.about');
});
Route::get('/users/{id}/{name}', function ($id,$name) {
    return 'This is user '.$name.'with and id '.$id;
});
*/
Route::get('/', 'HoursController@index');
Route::post('/edithour', 'HoursController@show');
Route::put('/update', 'HoursController@update');
Route::get('/destroy_hour', 'HoursController@destroy_hour');

Route::get('/reports', 'HoursController@reports');

Route::post('/loadmorehours', 'HoursController@loadhours');
Route::post('/loadhoursinreport', 'HoursController@loadhoursinreport');
Route::get('/about', 'PagesController@about');
//Route::get('/users', 'UsersController@index')->name('users');
Route::resource('users', 'UsersController');
//Route::get('/services', 'PagesController@services');

Route::resource('posts', 'PostsController');
Route::resource('services', 'ServicesController');
Route::resource('clients', 'ClientsController');
Route::resource('projects', 'ProjectCodesController');
Route::resource('contacts', 'ContactsController');
Route::resource('/', 'HoursController');
Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

//Route::get('/admin', 'UsersController@index');
Route::get('/admin', function () {
    return 'Hello World';
})->name('admin');