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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('department','DepartmentController');
Route::resource('user','UserController');
Route::resource('test','TestController');
Route::post('addquestion','TestController@addQuestion');
Route::get('addquestionview/{test_id}','TestController@addQuestionView');
Route::Delete('delquestion/{question}','TestController@deleteQuestion');
Route::get('editquestion/{question}/edit','TestController@editQuestion');
Route::patch('updatequestion/{question}', 'TestController@updateQuestion');
Route::resource('student','StudentController');
Route::get('student/create/{slug}', 'StudentController@create');
Route::post('studentresult','StudentController@addResults');
Route::get('showresult/{test}','StudentController@showResults');
Route::get('showtestresult/{student}','StudentController@showTestResult');
//summernote
//Route::post('/upload_image', '\TestController@uploadImage');
