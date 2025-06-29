<?php

use Core\Router;

Router::get('/', 'views/layout.php');

// Веб-маршруты для задач
Router::get('/tasks', 'Web\TaskController@index');
Router::get('/tasks/create', 'Web\TaskController@create');
Router::post('/tasks', 'Web\TaskController@store');
Router::get('/tasks/{id}', 'Web\TaskController@show');
Router::get('/tasks/{id}/edit', 'Web\TaskController@edit');
Router::post('/tasks/{id}', 'Web\TaskController@update');
Router::post('/tasks/{id}/delete', 'Web\TaskController@destroy');

// API-маршруты для задач
Router::get('/api/tasks', 'Api\TaskApiController@index');
Router::post('/api/tasks', 'Api\TaskApiController@store');
Router::get('/api/tasks/{id}', 'Api\TaskApiController@show');
Router::put('/api/tasks/{id}', 'Api\TaskApiController@update');
Router::delete('/api/tasks/{id}', 'Api\TaskApiController@destroy');