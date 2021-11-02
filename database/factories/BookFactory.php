<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->word(10),
        'isbn' => $faker->isbn10,
        'pages' => rand(10,100),
        'about' => $faker->paragraph(3),
        'author_id' => rand(1,4)
    ];
});
