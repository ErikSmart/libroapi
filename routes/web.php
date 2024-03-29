<?php

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

$router->get('/libro','LibroController@Index');
$router->get('/libro/{id}','LibroController@show');
$router->post('/libro','LibroController@store');
$router->put('/libro/{id}','LibroController@update');
$router->patch('/libro/{id}','LibroController@update');
$router->delete('/libro/{id}','LibroController@destroy');
