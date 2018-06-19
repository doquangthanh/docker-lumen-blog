# Docker Lumen Framework 
[![Build Status](https://travis-ci.org/doquangthanh/docker-lumen-blog.svg?branch=master)](https://travis-ci.org/doquangthanh/docker-lumen-blog)
### Install

Before you start make sure you have [Docker Compose](https://docs.docker.com/compose/install/) installed on your machine.

Clone the repo by running the following command
``
    $ git clone https://github.com/doquangthanh/docker-lumen-blog.git
``
### Config
Before you start your application make sure you have created the file **.env** with the correct Docker configuration values. Please take a look into the example on the file **.env.example**
``
    $ cp .env.example .env
``
### Run

To start you application you just need to run the following command 
``
    $ docker-compose up -d --build
``    
### Test
##### PHP-FPM
Give it 5min while composer installs all the Lumen dependencies automatically under the vendor folder.

Once it has finished you should be able to see Lumen's default page on your [browser](http://127.0.0.1).

##### PHP-CLI
In order to run PHP on the command line you can list all the containers by running 

    $ docker-compose ps
    
Assuming you left the the config value `COMPOSE_PROJECT_NAME=app` you should see a container running with the name **app_workspace_1**


All you have to do is to run the following command to use the workspace container as your main bash 

    $ docker exec -i -t blog_workspace_1 /bin/bash

And then you will have PHP ready for you, just give it a try!

    $ php artisan

### Run 
### 
	docker run --interactive --tty ubuntu bash
	
## Setup

Easy peasy, simply run the following commands:

* `composer install`
* `artisan:migrate`

### .env file

Duplicate `.env.example` and edit the following line to the bottom of your freshly created `.env` file. This will be the api token your other applications use to gain access to your micro-service. You **should** have secured your micro-services within a VPC or similar WAF to protect against unauthorised calls, but this gives you just that extra bit of protection, should you really need it.

API_TOKEN=**TOKEN_GOES_HERE**

## Available End Points

All end points require an `api_token` header, which is the same as the one you set in your `.env`  file.

### Get all posts

`GET /posts/all`  

Requires the following header:

* `api_token` the api token you added to your `.env` file (required)

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
      'created_at': (string) // created time eg: 2017-03-24 11:47:12,
      'update_at': (string) // updated time eg: 2017-03-24 11:47:12
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

* `api_token` the api token you added to your `.env` file (required)

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
    'created_at': (string) // created time eg: 2017-03-24 11:47:12,
    'update_at': (string) // updated time eg: 2017-03-24 11:47:12
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

* `api_token` the api token you added to your `.env` file (required)

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
    'created_at': (string) // created time eg: 2017-03-24 11:47:12,
    'update_at': (string) // updated time eg: 2017-03-24 11:47:12
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

* `api_token` the api token you added to your `.env` file (required)

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

* `api_token` the api token you added to your `.env` file (required)

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

## Unit testing

Easy, just run the command `phpunit` from the root directory, composer should install this for you.