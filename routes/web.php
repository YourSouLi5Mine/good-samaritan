<?php

$router->group(['prefix'=>'api/v1'], function() use($router) {
  $router->post('/signin', 'AuthController@authenticate');
  $router->post('/signup', 'UserController@create');
});

$router->group(['prefix'=>'api/v1', 'middleware'=>'jwt.auth'], function() use ($router) {
  $router->get('/users', 'UserController@index');
  $router->get('/users/{id}', 'UserController@show');
  $router->put('/users', 'UserController@update');
  $router->delete('/users', 'UserController@delete_myself');
  $router->delete('/admin/users/{id}', 'UserController@delete_other');

  $router->get('/groups', 'GroupController@index');
  $router->post('/groups', 'GroupController@create');
  $router->get('/groups/{id}', 'GroupController@show');
  $router->put('/groups/{id}', 'GroupController@update');
  $router->delete('/groups/{id}', 'GroupController@delete_my_group');
  $router->delete('/admin/groups/{id}', 'GroupController@delete_group');


  $router->get('/posts', 'PostController@index');
  $router->post('/posts', 'PostController@create');
  $router->get('/posts/{id}', 'PostController@show'); //Probably not needed
  $router->put('/posts/{id}', 'PostController@update');
  $router->delete('/posts/{id}', 'PostController@delete');
});
