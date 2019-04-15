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
  $router->get('/products', 'ProductController@index');
  $router->post('/products', 'ProductController@create');
  $router->get('/products/{id}', 'ProductController@show');
  $router->put('/products/{id}', 'ProductController@update');
  $router->delete('/products/{id}', 'ProductController@delete');
});
