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


Route::group(['middleware' => 'guest:student, guest:employer'], function(){
    Route::get('login', 'Auth\LoginController@index')->name('login.index');
    Route::post('login', 'Auth\LoginController@signIn');
    Route::get('register', 'Auth\RegisterController@index')->name('register.index');
    Route::post('register', 'Auth\RegisterController@signUp');


});

Route::group(['middleware' => 'auth:student'], function(){
    Route::get('/', 'SpecialityController@show')->name('student.index');
    Route::get('{studyCard}/terms', 'TermController@show')->name('student.term');

    Route::get('discipline/{wnpDisciplineSem}-{slug}', 'DisciplineController@showMarks')->name('discipline.showMarks');
//    Route::get('profile', 'StudentController@show')->name('profile');

    Route::post('/ajaxRequest', 'AjaxController@showStudDisciplines');
});

Route::group(['middleware' => 'auth:employer'], function(){

    Route::get('term', 'TermController@showEmployerTerms')->name('employer.index');
    Route::get('term/{wnpDisciplineSem}-{slug}', 'DisciplineController@showJournal')->name('discipline.showJournal');

    Route::post('/storeTestResult', 'AjaxController@storeTestResult');
    Route::delete('/destroyTestResult', 'AjaxController@destroyTestResult');

//    Route::get('study-types/create', 'StudyTypeController@create')->name('study-type.create');
//    Route::post('study-types', 'StudyTypeController@store')->name('study-type.store');
    Route::get('division', 'DivisionController@show')->name('division.show');
    Route::post('division-editemp', 'DivisionController@storeAddEditEmpTypeModal');
    Route::delete('division-editemp-delete', 'DivisionController@destroyAddEditEmpTypeModal');
    Route::get('division/group-list-{divisionId}', 'GroupController@index')->name('group-list.index');
    Route::post('division/group-list/students', 'GroupController@getAjaxStudentList');
    Route::post('division/group-list/toexel', 'GroupController@toExel');

    //Dekanat Role
    Route::get('divisions', 'DivisionController@index')->name('division.index');
    Route::get('divisions/{group}/statements', 'StatementController@index')->name('statement.index');
    Route::get('divisions/{group}/statements/{semester}/{attestation}', 'StatementController@show')->name('statement.show');
    Route::post('divisions/{group}/statements/{semester}/{attestation}/print', 'StatementController@show')->where('attestation', '[1-2]')->name('statement.print');
    Route::post('divisions/{group}/statements/{semester}/{attestation}/excel', 'StatementController@show')->where('attestation', '[1-2]')->name('statement.excel');

    //Zavkaf Role
    Route::post('disciplines', 'DisciplineController@store')->name('discipline.store');
    Route::get('disciplines/{testDiscipline}/edit', 'DisciplineController@edit');
    Route::post('disciplines/{testDiscipline}', 'DisciplineController@update');
    Route::delete('disciplines/{testDiscipline}', 'DisciplineController@destroy');
    Route::post('disciplines-copy', 'DisciplineController@storeCopy')->name('discipline.storeCopy');
    Route::post('disciplines-study-subtype', 'DisciplineController@showStudySubTypes')->name('discipline.showStudySubTypes');

});
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//http://127.0.0.1:8000/divisions/GKHNITMSORYY/statements/8PT84W1R611V/1
//http://127.0.0.1:8000/divisions/H97PPRE7LTHA/statements/12VI9CPP2DIB/1

