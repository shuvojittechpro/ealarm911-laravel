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
Route::get('/admin', function () {
    return View::make('admin.home');
});
Route::post('/admin/process_login', 'HomeController@process_login');
Route::get('/admin/process_logout', 'HomeController@process_logout');
Route::get('/admin/dashboard', function () {
    return View::make('admin.dashboard');
});
Route::get('/admin/user', function() {
    return View::make('admin.user_list');
});
Route::get('/admin/get_userlist', 'UserController@response_user_list');
Route::get('/admin/security_questions', function() {
    return View::make('admin.security_questions_list');
});
Route::get('/admin/add_security_questions', function() {
    return View::make('SequrityQuestionController@add');
});
Route::get('/admin/response_questions_list','SequrityQuestionController@response_security_questions_list');
Route::post('/admin/change_security_questions_status','SequrityQuestionController@change_status');
