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
Route::resource('questionnair', 'QuestionnairController');
Route::resource('questionnair/question', 'QuestionController');
Route::get('/questionnair/{questionnair}/question/create', 'QuestionController@create')->name('questionnair.question');

Route::get('/api/questionnairs', 'QuestionnairController@questionnairs_json')->name('api.questionnairs');
Route::get('/results', 'QuestionnairController@index')->name('results');
Route::get('/questionnair/{questionnair}/delete', 'QuestionnairController@destroy')->name('questionnair.remove');

