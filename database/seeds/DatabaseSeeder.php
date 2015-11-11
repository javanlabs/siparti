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
        $user = factory(\App\Entities\User::class)->create([
            'email'  => 'root@laravolt.com',
            'status' => \App\Enum\UserStatus::ACTIVE()
        ]);
        $user->assignRole($root);

        $users = factory(\App\Entities\User::class, 100)->create();

        factory(\App\Entities\Post::class, 10)->make()->each(function ($post) use ($users) {
            $author = $users->random();
            $post->setResponsibleUser($author);
            $post->author()->associate($author);
            $post->save();
        });

        factory(\App\Entities\Satker::class, 10)->create()->each(function($satker){
            factory(\App\Entities\ProgramKerja::class, 10)->create(['satker_id' => $satker->id])->each(function($proker){
                factory(\App\Entities\Fase::class)->create(['type' => \App\Enum\FaseType::PERENCANAAN, 'proker_id' => $proker->id, 'satker_id' => $proker->satker_id]);
                factory(\App\Entities\Fase::class)->create(['type' => \App\Enum\FaseType::PELAKSANAAN, 'proker_id' => $proker->id, 'satker_id' => $proker->satker_id]);
                $fase = factory(\App\Entities\Fase::class)->create(['type' => \App\Enum\FaseType::PENGAWASAN, 'proker_id' => $proker->id, 'satker_id' => $proker->satker_id]);

                $proker->current_fase_id = $fase->id;
                $proker->save();
            });
        });

        factory(\App\Entities\ProgramKerjaUsulan::class, 50)->create();

        factory(\App\Entities\UjiPublik::class, 50)->create();

        Model::reguard();
    }
}
