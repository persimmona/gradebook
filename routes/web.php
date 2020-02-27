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


Route::group(['middleware' => 'guest:student'], function(){
	Route::post('register', 'Auth\RegisterController@postRegister')->name('postRegister');
	Route::get('register', 'Auth\RegisterController@showRegisterForm')->name('register');
	Route::post('login','Auth\LoginController@postLogin')->name('postLogin');
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
});

Route::group(['middleware' => 'auth:student'], function(){
	Route::get('logout', 'Auth\LoginController@logout')->name('logout');
	Route::get('{studyCard}/terms', 'TermController@show')->name('terms');
    Route::get('/', 'SpecialityController@show')->name('speciality');
    Route::get('terms/{discipline}-{slug}', 'DisciplineController@show')->name('discipline');
    Route::get('profile', 'StudentController@show')->name('profile');

    Route::post('/ajaxRequest', 'AjaxController@show')->name('ajax');
});

