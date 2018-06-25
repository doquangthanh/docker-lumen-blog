<?php

$router->get('/', function () {
    return 'Micro-services and blazing fast APIs';
});

// Route::post('/api/register', 'RegisterController@register');

$router->group([
    'prefix' => 'posts'
], function ($router) {
    $router->get('/', 'PostsController@posts');
    $router->post('/', 'PostsController@createPost');
    $router->get('{id}', 'PostsController@postById');
    $router->put('/{id}/', 'PostsController@updatePost');
    $router->delete('/{id}/', 'PostsController@deletePost');
});

$router->group([
    'prefix' => 'tags'
], function ($router) {
    $router->get('/', 'TagsController@tags');
    $router->get('{id}', 'TagsController@tagById');
});

$router->group([
    'prefix' => 'categories'
], function ($router) {
    $router->get('/', 'CategoriesController@categories');
    $router->get('{id}', 'CategoriesController@categoryById');
});

$router->post('/api/login', 'UsersController@login');

$router->group(['middleware' => 'auth','prefix' => 'api/users'], function ($router){
    $router->get('/', 'UsersController@getUsers');
    $router->get('{id}/posts', 'UsersController@getUserPosts');
    $router->get('{id}/posts/{postId}', 'UsersController@getUserPost');
    $router->get('{id}/comments', 'UsersController@getUserComments');
    $router->get('{id}/comments/{commentId}', 'UsersController@getUserComment');
    $router->get('{id}', 'UsersController@getUser');
    $router->post('/', 'UsersController@createUser');
    $router->delete('{id}', 'UsersController@deleteUser');
    $router->put('{id}', 'UsersController@updateUser');
});
    