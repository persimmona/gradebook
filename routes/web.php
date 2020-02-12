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

Route::get('/', function () {
    return view('welcome');
});

Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');

Route::get('profile', 'StudentController@show')->name('profile');//для посредника студент
//add students/{student} в зависимости от авторизации (при сохранении передавать id параметром в роут)
Route::get('/terms', 'TermController@index')->name('terms');//после авторизации сюда
//как я узнаю какая специальность у него?
Route::get('/terms/{discipline}-{slug}', 'DisciplineController@show')->name('discipline');


// использовать именованнные роуты

//функция получения авторизированного студента (пока делать на основе рандомного студента)
// как идет проверка на студента или преподавателя (при входе чекбокс)
