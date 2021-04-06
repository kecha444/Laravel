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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'TaskController@index');
Route::post('/task', 'TaskController@create');
// Маршрут для формы, принимает форму и передаёт в метод create прописанный в контроллере
Route::delete('/task/{task}', 'TaskController@delete');// метод delet доступев laravel - это обычный post запрос с доп полем для необходимой обработки( мы будем передавать /tasks/id)
Route::get('/task/{task}', 'TaskController@show');// В {} имя модели пишем
Route::post('/task/{task}', 'TaskController@update');

Route::post('/task/{task}/addgroup', 'TaskController@add_group');
Route::delete('/task/{task}/delgroup/{group}', 'TaskController@del_group');///task/{task}/delgroup/{group} удаляем у таска группу поэтому передаё 2 модели и еще слово чтобы url не повторялся





// Маршруты для статусов
Route::get('/status', 'StatusController@index');
Route::post('/status', 'StatusController@create');
Route::delete('/status/{status}', 'StatusController@delete');
Route::get('/status/{status}', 'StatusController@show');
Route::post('/status/{status}', 'StatusController@update');

// Маршруты для заметок
Route::get('/note', 'NoteController@index');
Route::post('/note', 'NoteController@create');
Route::delete('/note/{note}', 'NoteController@delete');
Route::get('/note/{note}', 'NoteController@show');
Route::post('/note/{note}', 'NoteController@update');







Auth::routes();//автоматически добавились после make auth

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/groups', 'GroupsController@index');
Route::post('/groups', 'GroupsController@create');
Route::delete('/groups/{group}', 'GroupsController@delete');
Route::get('/groups/{group}', 'GroupsController@show');
Route::post('/groups/{group}', 'GroupsController@update');

Route::get('/ajax', 'AjaxController@index');
Route::get('/ajax/tasks', 'AjaxController@tasks_list');
Route::post('/ajax', 'AjaxController@create');
Route::delete('/ajax/{task}', 'AjaxController@delete');


Route::get('/statusajax', 'StatusAjaxController@index');
Route::get('/statusajax/tasks', 'StatusAjaxController@tasks_list');
Route::post('/statusajax', 'StatusAjaxController@create');
Route::delete('/statusajax/{task}', 'StatusAjaxController@delete');











