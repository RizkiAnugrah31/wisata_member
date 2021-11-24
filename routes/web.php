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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Contoh
$router->get('/contoh', 'ContohController@exampleGet');
$router->post('/contoh', 'ContohController@examplePost');
// End Contoh

$router->get('/Employee/fetch','Cms\EmployeeController@index');
$router->get('/Employee/detail/{id}','Cms\EmployeeController@detail');
$router->post('/Employee/store','Cms\EmployeeController@store');
$router->put('/Employee/update/{id}','Cms\EmployeeController@update');
$router->delete('/Employee/delete/{id}','Cms\EmployeeController@delete');

$router->get('/UserRoles/fetch','Cms\UserRolesController@index');
$router->get('/UserRoles/detail/{id}','Cms\UserRolesController@detail');
$router->post('/UserRoles/store','Cms\UserRolesController@store');
$router->put('/UserRoles/update/{id}','Cms\UserRolesController@update');
$router->delete('/UserRoles/delete/{id}','Cms\UserRolesController@delete');

$router->post('/Employee/login', 'Cms\AuthController@login');




