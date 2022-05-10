<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/infos', function () {
    return response()->json(['author' => '@Jphn'], 200);
});

$router->get('/todos/{id}', 'TodosController@getTodo');
$router->post('/todos', 'TodosController@postTodo');
$router->put('/todos/{id}/status/done', 'TodosController@putTodoDone');
$router->put('/todos/{id}/status', 'TodosController@putTodoStatus');
$router->delete('/todos/{id}', 'TodosController@deleteTodo');
