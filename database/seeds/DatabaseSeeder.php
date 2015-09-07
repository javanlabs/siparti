<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        factory(\App\Models\User::class, 10)->create();
        factory(\App\Models\Post::class, 10)->create();

        Model::reguard();
    }
}
