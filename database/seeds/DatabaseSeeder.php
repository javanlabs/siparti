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

        // root user
        factory(\App\Models\User::class)->create(['email' => 'root@laravolt.com', 'status' => 'active']);

        factory(\App\Models\User::class, 10)->create();
        factory(\App\Models\Post::class, 10)->create();

        Model::reguard();
    }
}
