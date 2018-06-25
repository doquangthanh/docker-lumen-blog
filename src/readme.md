# Lumen micro-service for blog posts
## Build Code blog framework
[![Build Status](https://travis-ci.org/doquangthanh/docker-lumen-blog.svg?branch=master)](https://travis-ci.org/doquangthanh/docker-lumen-blog)
## Build framework
[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework) 
[![Total Downloads](https://poser.pugx.org/laravel/lumen-framework/d/total.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/lumen-framework/v/stable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/lumen-framework/v/unstable.svg)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)



Very simple micro service with even simpler token based authentication.

## Setup

Easy peasy, simply run the following commands:
* `git clone` repository url
* `composer install`
* `php artisan migrate`

## Features

- RESTful routing
- Models with proper relationships
- Controllers/Models etc with proper separation of concerns
- Authentication
- RESTful errors

### .env file

Duplicate `.env.example` and edit the following line to the bottom of your freshly created `.env` file. This will be the api token your other applications use to gain access to your micro-service. You **should** have secured your micro-services within a VPC or similar WAF to protect against unauthorised calls, but this gives you just that extra bit of protection, should you really need it.


## Available End Points

All end points require an `api_token` header, which is the same as the one you set in your `.env`  file.
###  Gen api key token
`POST /api/login`  

Body:

```JSON
{
"email" : "email@gmail.com",
"password" : "demo@123"
}
```

Returns JSON
```javascript
{
    "status": "success",
    "api_key": "YWZTcWd5Mzh2OWlobnFxV1p1eE1iMnY2b21IOGxxUng="
}
```

### Get all posts

`GET /posts/all`  

Requires the following header:

Returns JSON  

```javascript
// Valid response 200
{
  'success': true,
  'data': [
    {
      'id': (int) // post id,
      'user_id': (int) // user id of post,
      'title': (string) // post title,
      'content': (string) // post content,
      'created_at': (string) // created time eg: 2018-06-24 11:47:12,
      'update_at': (string) // updated time eg: 2018-06-24 11:47:12
    }
  ]
}

// Invalid response {response code}
{
  'success': false,
  'data': {
    'message': (string),
  }
}
```

### Get post

`GET /posts/get/{id}`  

Accepts the following parameters:

* `{id}` being the id of the post you are requesting (required).  

Accepts the following header:

* `api_token` the api token you added to your header: Authentication: bearer `api_token` (required)

Returns JSON  

```javascript
// Valid response 200
{
  'success': true,
  'data': {
    'id': (int) // post id,
    'user_id': (int) // user id of post,
    'title': (string) // post title,
    'content': (string) // post content,
    'created_at': (string) // created time eg: 2018-06-24 11:47:12,
    'update_at': (string) // updated time eg: 2018-06-24 11:47:12
  }
}

// Invalid response {response code}
{
  'success': false,
  'data': {
    'message': (string),
  }
}
```

### Insert post

`PUT /posts/{api_token}/insert`  

Accepts the following parameters:  

* `user_id` (int) id of user that owns post (required)
* `title` (string) post title (required)
* `content` (string) post content (required)  

Accepts the following header:

* `api_token` the api token you added to your header: Authentication: bearer `api_token`  (required)

Returns JSON  

```javascript
// Valid response 200
{
  'success': true,
  'data': {
    'id': (int) // post id,
    'user_id': (int) // user id of post,
    'title': (string) // post title,
    'content': (string) // post content,
    'created_at': (string) // created time eg: 2018-06-24 11:47:12,
    'update_at': (string) // updated time eg: 2018-06-24 11:47:12
  }
}

// Invalid response {response code}
{
  'success': false,
  'data': {
    'message': (string),
  }
}
```

### Delete post

`DELETE /posts/{api_token}/delete`  

Accepts the following parameter:  

* `id` (int) id of post you wish to delete (required)  

Accepts the following header:

* `api_token` the api token you added to your header: Authentication: bearer `api_token`  (required)

Returns JSON  

```javascript
// Valid response 200
{
  'success': true,
  'data': {
    'id': (int) //post id
  }
}

// Invalid response {response code}
{
  'success': false,
  'data': {
    'message': (string),
  }
}
```

### Update post

`PUT /posts/{api_token}/update`  

Accepts the following parameters:  

* `id` (int) id of post to update (required)
* `user_id` (int) id of user that owns post
* `title` (string) post title
* `content` (string) post content  

Accepts the following header:  

* `api_token` the api token you added to your header: Authentication: bearer `api_token`  (required)

Returns JSON  

```javascript
// Valid response 200
{
  'success': true,
  'data': {
    'id': (int),
    'user_id': (int),
    'title': (string),
    'content': (string),
    'created_at': (string),
    'update_at': (string)
  }
}

// Invalid response {response code}
{
  'success': false,
  'data': {
    'message': (string),
  }
}
```


## Routes List:

### Comments

| Method     | URI                               | Action                                                  |
|------------|-----------------------------------|---------------------------------------------------------|
| `POST`     | `comments`                        | `App\Http\Controllers\CommentsController@createComment` |
| `GET/HEAD` | `comments`                        | `App\Http\Controllers\CommentsController@getComments`   |
| `GET/HEAD` | `comments/{id}`                   | `App\Http\Controllers\CommentsController@getComment`    |
| `DELETE`   | `comments/{id}`                   | `App\Http\Controllers\CommentsController@deleteComment` |
| `PUT`      | `comments/{id}`                   | `App\Http\Controllers\CommentsController@updateComment` |

### Posts

| Method     | URI                               | Action                                                  |
|------------|-----------------------------------|---------------------------------------------------------|
| `POST`     | `posts`                           | `App\Http\Controllers\PostsController@createPost`       |
| `GET/HEAD` | `posts`                           | `App\Http\Controllers\PostsController@getPosts`         |
| `PUT`      | `posts/{id}`                      | `App\Http\Controllers\PostsController@updatePost`       |
| `GET/HEAD` | `posts/{id}`                      | `App\Http\Controllers\PostsController@getPost`          |
| `DELETE`   | `posts/{id}`                      | `App\Http\Controllers\PostsController@deletePost`       |

### Users

| Method     | URI                               | Action                                                  |
|------------|-----------------------------------|---------------------------------------------------------|
| `GET/HEAD` | `users`                           | `App\Http\Controllers\UsersController@getUsers`         |
| `POST`     | `users`                           | `App\Http\Controllers\UsersController@createUser`       |
| `PUT`      | `users/{id}`                      | `App\Http\Controllers\UsersController@updateUser`       |
| `GET/HEAD` | `users/{id}`                      | `App\Http\Controllers\UsersController@getUser`          |
| `DELETE`   | `users/{id}`                      | `App\Http\Controllers\UsersController@deleteUser`       |
| `GET/HEAD` | `users/{id}/comments`             | `App\Http\Controllers\UsersController@getUserComments`  |
| `GET/HEAD` | `users/{id}/comments/{commentId}` | `App\Http\Controllers\UsersController@getUserComment`   |
| `GET/HEAD` | `users/{id}/posts`                | `App\Http\Controllers\UsersController@getUserPosts`     |
| `GET/HEAD` | `users/{id}/posts/{postId}`       | `App\Http\Controllers\UsersController@getUserPost`      |
## Unit testing

Easy, just run the command `phpunit` from the root directory, composer should install this for you.

## Left to do

* Get posts by user id
* Bulk update / edit / insert / get
* Validation and better error responses
* Better managment of tokens
