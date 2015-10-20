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
        factory(\App\Entities\User::class)->create(['email' => 'root@laravolt.com', 'status' => \App\Enum\UserStatus::ACTIVE()]);

        factory(\App\Entities\User::class, 100)->create();

        factory(\App\Entities\Post::class, 10)->create();

        Model::reguard();
    }
}
