<?php

$app->get('/', function () use ($app) {
    return $app->version();
});

// Route::post('/api/register', 'RegisterController@register');

$app->group(['prefix' => 'posts'], function ($app) {
    $app->get('/','PostsController@posts');
    $app->post('/','PostsController@createPost');
    $app->get('{id}', 'PostsController@postById');
    $app->put('/{id}/','PostsController@updatePost');
    $app->delete('/{id}/','PostsController@deletePost');
});

$app->group(['prefix' => 'tags'], function ($app) {
    $app->get('/','TagsController@tags');
    $app->get('{id}', 'TagsController@tagById');
});

$app->group(['prefix' => 'categories'], function ($app) {
    $app->get('/','CategoriesController@categories');
    $app->get('{id}', 'CategoriesController@categoryById');
});