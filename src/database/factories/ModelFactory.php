<?php

use Carbon\Carbon;

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(6, true),
        'content' => $faker->paragraphs(3, true),
        'status' => $faker->numberBetween(1, 3),
        'slug' => $faker->slug,
        'recommends' => $faker->randomDigit,
        'rating' => $faker->randomFloat(NULL, 1, 5),
        'category_id' => $faker->numberBetween(1, 10),
        'author_id' => $faker->numberBetween(1, 20),
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'email' => $faker->email,
        'password' => $faker->password,
        'avatar' => $faker->imageUrl(70, 70, 'people'),
        'cover' => $faker->imageUrl(640, 480, 'people'),
        'birthday' => $faker->dateTimeBetween($startDate = '-90 years', $endDate = '-18 years'),
        'nickname' => $faker->name,
        'occupation' => $faker->jobTitle,
        'address' => $faker->address,
        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->jobTitle
    ];
});