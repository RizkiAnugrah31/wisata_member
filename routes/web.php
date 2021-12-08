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
$router->get('/contoh', 'ContohController@fetch');
$router->get('/contoh/{id}', 'ContohController@detail');
$router->post('/contoh', 'ContohController@store');
$router->put('/contoh/{id}', 'ContohController@update');
$router->delete('/contoh/{id}', 'ContohController@destroy');
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

$router->get('/Credentials/fetch','Cms\CredentialsController@index');
$router->get('/Credentials/detail/{id}','Cms\CredentialsController@detail');
$router->post('/Credentials/store','Cms\CredentialsController@store');
$router->put('/Credentials/update/{id}','Cms\CredentialsController@update');
$router->delete('/Credentials/delete/{id}','Cms\CredentialsController@delete');

$router->post('/Credentials/login', 'Cms\TokenController@login');

$router->get('/Menus/fetch','Cms\MenusController@index');
$router->get('/Menus/detail/{id}','Cms\MenusController@detail');
$router->post('/Menus/store','Cms\MenusController@store');
$router->put('/Menus/update/{id}','Cms\MenusController@update');
$router->delete('/Menus/delete/{id}','Cms\MenusController@delete');

$router->get('/MenuGroups/fetch','Cms\MenuGroupsController@index');
$router->get('/MenuGroups/detail/{id}','Cms\MenuGroupsController@detail');
$router->post('/MenuGroups/store','Cms\MenuGroupsController@store');
$router->put('/MenuGroups/update/{id}','Cms\MenuGroupsController@update');
$router->delete('/MenuGroups/delete/{id}','Cms\MenuGroupsController@delete');

$router->get('/UserPrivileges/fetch','Cms\UserPrivilegesController@index');
$router->get('/UserPrivileges/detail/{id}','Cms\UserPrivilegesController@detail');
$router->post('/UserPrivileges/store','Cms\UserPrivilegesController@store');
$router->put('/UserPrivileges/update/{id}','Cms\UserPrivilegesController@update');
$router->delete('/UserPrivileges/delete/{id}','Cms\UserPrivilegesController@delete');

