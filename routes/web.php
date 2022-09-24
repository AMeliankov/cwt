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

$router->get('/', ['as' => 'home', function () use ($router) {
    return $router->app->version();
}]);

$router->group(['namespace' => 'V1', 'prefix' => 'api/v1'], function () use ($router): void {

    $router->group(['namespace' => 'Spec', 'prefix' => 'docs'], function () use ($router) {
        $router->get('/', ['as' => 'docs', 'uses' => 'OpenApiController@docs']);
        $router->get('/spec', ['as' => 'spec', 'uses' => 'OpenApiController@spec']);
    });

    $router->group(['prefix' => 'users', 'namespace' => 'User'], function () use ($router) {
        $router->post('/', ['as' => 'users.store', 'uses' => 'UserController@store']);
        $router->patch('/{id}', ['as' => 'users.update', 'uses' => 'UserController@update']);
        $router->delete('/{id}', ['as' => 'users.destroy', 'uses' => 'UserController@destroy']);
        $router->get('/{id}', ['as' => 'users.show', 'uses' => 'UserController@show']);
        $router->get('/', ['as' => 'users.index', 'uses' => 'UserController@index']);
        $router->group(['prefix' => '{id}/relationships'], function () use ($router) {
            $router->get('/role', ['as' => 'users.relationships.role', 'uses' => 'UserRoleRelationshipController@show']);
            $router->get('/visits', ['as' => 'users.relationships.visits', 'uses' => 'UserVisitsRelationshipController@index']);
        });
        $router->get('/{id}/role', ['as' => 'users.role', 'uses' => 'UserRoleRelationController@show']);
        $router->get('/{id}/visits', ['as' => 'users.visits', 'uses' => 'UserVisitsRelationController@index']);
    });

    $router->group(['prefix' => 'roles', 'namespace' => 'Role'], function () use ($router) {
        $router->post('/', ['as' => 'roles.store', 'uses' => 'RoleController@store']);
        $router->patch('/{id}', ['as' => 'roles.update', 'uses' => 'RoleController@update']);
        $router->delete('/{id}', ['as' => 'roles.destroy', 'uses' => 'RoleController@destroy']);
        $router->get('/{id}', ['as' => 'roles.show', 'uses' => 'RoleController@show']);
        $router->get('/', ['as' => 'roles.index', 'uses' => 'RoleController@index']);
        $router->group(['prefix' => '{id}/relationships'], function () use ($router) {
            $router->get('/users', ['as' => 'roles.relationships.users', 'uses' => 'RoleUsersRelationshipController@index']);
        });
        $router->get('/{id}/users', ['as' => 'roles.users', 'uses' => 'RoleUsersRelationController@index']);
    });

    $router->group(['prefix' => 'visits', 'namespace' => 'Visit'], function () use ($router) {
        $router->post('/', ['as' => 'visits.store', 'uses' => 'VisitController@store']);
        $router->patch('/{id}', ['as' => 'visits.update', 'uses' => 'VisitController@update']);
        $router->delete('/{id}', ['as' => 'visits.destroy', 'uses' => 'VisitController@destroy']);
        $router->get('/{id}', ['as' => 'visits.show', 'uses' => 'VisitController@show']);
        $router->get('/', ['as' => 'visits.index', 'uses' => 'VisitController@index']);
        $router->group(['prefix' => '{id}/relationships'], function () use ($router) {
            $router->get('/user', ['as' => 'visits.relationships.user', 'uses' => 'VisitUserRelationshipController@show']);
        });
        $router->get('/{id}/user', ['as' => 'visits.user', 'uses' => 'VisitUserRelationController@show']);
    });

});
