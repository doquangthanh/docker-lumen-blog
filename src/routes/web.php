<?php

$router->get('/', function () {
    return 'Hello World';
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