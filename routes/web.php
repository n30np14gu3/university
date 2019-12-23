<?php
use \Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('pages.welcome'); });

Route::group(['prefix' => 'management'], function(){
    Route::get('form_count',  function () {return view('pages.form_count'); });
    Route::get('students',  ['uses' => 'managementController@studentsPrepare']);
    Route::get('discipline_info',  ['uses' => 'managementController@disciplinePrepare']);
});

Route::group(['prefix' => 'action'], function (){
   Route::get('form_count', ['uses' => 'managementController@formCount']);
   Route::get('discipline_info', ['uses' => 'managementController@disciplineInfo']);
   Route::get('get_student_info', ['uses' => 'managementController@getStudentInfo']);
   Route::post('create_student', ['uses' => 'managementController@createStudent']);
   Route::post('edit_student', ['uses' => 'managementController@editStudent']);
});
