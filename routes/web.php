<?php
use \Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('pages.welcome'); });
Route::get('/get_info', ['uses' => 'managementController@getInfoPrepare']);

Route::group(['prefix' => 'management'], function(){
    Route::get('form_count',  function () {return view('pages.form_count'); });
    Route::get('students',  ['uses' => 'managementController@studentsPrepare']);
    Route::get('discipline_info',  ['uses' => 'managementController@disciplinePrepare']);
    Route::get('marks',  ['uses' => 'managementController@markPrepare']);
    Route::get('plan', ['uses' => 'managementController@planPrepare']);

});

Route::group(['prefix' => 'action'], function (){
   Route::get('form_count', ['uses' => 'managementController@formCount']);

   Route::get('discipline_info', ['uses' => 'managementController@disciplineInfo']);

   Route::get('get_student_info', ['uses' => 'managementController@getStudentInfo']);
   Route::post('create_student', ['uses' => 'managementController@createStudent']);
   Route::post('edit_student', ['uses' => 'managementController@editStudent']);

    Route::get('get_plan_info', ['uses' => 'managementController@getPlanInfo']);
    Route::post('create_plan', ['uses' => 'managementController@createPlan']);
    Route::post('edit_plan', ['uses' => 'managementController@editPlan']);

    Route::get('get_mark_info', ['uses' => 'managementController@getMarkInfo']);
    Route::post('create_mark', ['uses' => 'managementController@createMark']);
    Route::post('edit_mark', ['uses' => 'managementController@editMarkInfo']);
    Route::get('get_info', ['uses' => 'managementController@getInfo']);
});
