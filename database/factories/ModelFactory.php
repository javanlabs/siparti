<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name'              => $faker->name,
        'email'             => $faker->email,
        'password'          => bcrypt('password'),
        'password_last_set' => new Carbon\Carbon(),
        'remember_token'    => str_random(10),
    ];
});

$factory->define(App\Entities\Profile::class, function (Faker\Generator $faker) {
    return [
        'bio'      => $faker->paragraph(),
        'timezone' => $faker->timezone,
    ];
});

$factory->define(App\Entities\Post::class, function (Faker\Generator $faker) {
    return [
        'title'   => $faker->sentence(),
        'content' => $faker->paragraph(10),
    ];
});

$factory->define(App\Entities\Satker::class, function (Faker\Generator $faker) {
    return [
        'name'   => $faker->company,
    ];
});

$factory->define(App\Entities\Fase::class, function (Faker\Generator $faker) {
    return [
        'description'   => $faker->paragraphs(5, true),
        'scope' => $faker->paragraph(10),
        'instansi_terkait' => $faker->company,
        'start_date' => $faker->date(),
        'end_date' => $faker->date(),
        'progress' => $faker->sentence(),
        'kendala' => $faker->sentence(),
        'pic' => $faker->name,
        'target' => $faker->sentence(),
        'pagu' => $faker->numberBetween(1000000, 999999999)
    ];
});

$factory->define(App\Entities\ProgramKerja::class, function (Faker\Generator $faker) {
    return [
        'name'   => $faker->sentence(),
        'creator_id' => factory(\App\Entities\User::class)->create()->id
    ];
});

$factory->define(App\Entities\ProgramKerjaUsulan::class, function (Faker\Generator $faker) {
    return [
        'name'   => $faker->sentence(255),
        'creator_id' => factory(\App\Entities\User::class)->create()->id,
        'instansi_stakeholder' => $faker->company
    ];
});

$factory->define(App\Entities\UjiPublik::class, function (Faker\Generator $faker) {
    return [
        'name'   => $faker->sentence(),
        'creator_id' => factory(\App\Entities\User::class)->create()->id,
        'materi' => $faker->paragraph(),
    ];
});
