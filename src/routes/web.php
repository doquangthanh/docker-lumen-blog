<?php

/*
 * |--------------------------------------------------------------------------
 * | Application Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register all of the routes for an application.
 * | It is a breeze. Simply tell Lumen the URIs it should respond to
 * | and give it the Closure to call when that URI is requested.
 * |
 */
$router->get('/', function () use ($router) {
    return "microservice blog";
});

$router->get('/posts/all', 'PostsController@getAllPosts');
$router->get('/posts/get/{id}', 'PostsController@getPost');
$router->delete('/posts/delete', 'PostsController@deletePost');
$router->put('/posts/insert', 'PostsController@insertPost');
$router->put('/posts/update', 'PostsController@updatePost');

$router->get('/categories/all', 'CategoriesController@getAllCategories');
$router->get('/categories/get/{id}', 'CategoriesController@getCategory');
$router->delete('/categories/delete', 'CategoriesController@deleteCategory');
$router->put('/categories/insert', 'CategoriesController@insertCategory');
$router->put('/categories/update', 'CategoriesController@updateCategory');
