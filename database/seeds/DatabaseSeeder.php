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

        // root role
        $root = \Laravolt\Acl\Models\Role::create(['name' => 'root']);

        // root user
        $user = factory(\App\Entities\User::class)->create(['email' => 'root@laravolt.com', 'status' => \App\Enum\UserStatus::ACTIVE()]);
        $user->assignRole($root);

        factory(\App\Entities\User::class, 100)->create();

        factory(\App\Entities\Post::class, 10)->make()->each(function($post){
            $post->setResponsibleUser(\App\Entities\User::first());
            $post->save();
        });

        Model::reguard();
    }
}
