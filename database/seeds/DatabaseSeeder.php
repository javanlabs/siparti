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
        $root = factory(\App\Entities\User::class)->create(['email' => 'root@laravolt.com', 'status' => \App\Enum\UserStatus::ACTIVE()]);
        $root->profile()->save(factory(\App\Entities\Profile::class)->make());

        factory(\App\Entities\User::class, 100)
            ->create()
            ->each(function($u){
                $u->profile()->save(factory(\App\Entities\Profile::class)->make());
            });

        factory(\App\Entities\Post::class, 10)->create();

        Model::reguard();
    }
}
