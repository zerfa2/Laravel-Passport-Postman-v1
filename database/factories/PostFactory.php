<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'author_id' => \App\User::all()->random()->id,
        'title'=> $faker->sentence($nbWords=6, $variableNbWords=true),
        'content' => $faker->text($maxNbChars= 200)
    ];
});
