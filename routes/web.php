<?php /* |-------------------------------------------------------------------------- | Application Routes |-------------------------------------------------------------------------- |
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
  return $router->app->version();
});

$router->group(['prefix'=>'api/v1'], function () use($router) {
  $router->get('/users', 'UserController@index');
  $router->post('/users', 'UserController@create');
  $router->get('/users/{id}', 'UserController@show');
  $router->put('/users/{id}', 'UserController@update');
  $router->delete('/users/{id}', 'UserController@delete');
});

$router->group(['prefix'=>'api/v1'], function () use($router) {
  $router->get('/groups', 'GroupController@index');
  $router->post('/groups', 'GroupController@create');
  $router->get('/groups/{id}', 'GroupController@show');
  $router->put('/groups/{id}', 'GroupController@update');
  $router->delete('/groups/{id}', 'GroupController@delete');
});

$router->group(['prefix'=>'api/v1'], function () use($router) {
  $router->get('/posts', 'PostController@index');
  $router->post('/posts', 'PostController@create');
  $router->get('/posts/{id}', 'PostController@show');
  $router->put('/posts/{id}', 'PostController@update');
  $router->delete('/posts/{id}', 'PostController@delete');
});

$router->group(['prefix'=>'api/v1'], function () use($router) {
  $router->post('/auth/login', 'AuthController@authenticate');
});

$router->group(['middleware' => 'jwt.auth'], function() use ($router) {
  $router->get('/users/all', 'UserController@jwt_decoded');
});
