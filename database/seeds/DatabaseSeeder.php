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
        $admin = \Laravolt\Acl\Models\Role::create(['name' => 'admin']);
        $adminUjiPublik = \Laravolt\Acl\Models\Role::create(['name' => 'admin-uji-publik']);

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

        $this->command->info('Start Seed Satker, ProgramKerja, and Fase');
        factory(\App\Entities\Satker::class, 10)->create()->each(function ($satker) {
            factory(\App\Entities\ProgramKerja::class, 10)->create(['satker_id' => $satker->id])->each(function ($proker
            ) {
                $fase = factory(\App\Entities\Fase::class)->create([
                    'type'      => \App\Enum\FaseType::PERENCANAAN,
                    'proker_id' => $proker->id,
                    'satker_id' => $proker->satker_id
                ]);
                $fase->addDocument(base_path('resources/assets/files/sample.doc'));
                $fase->addDocument(base_path('resources/assets/files/sample.pdf'));

                $fase = factory(\App\Entities\Fase::class, 'berjalan')->create([
                    'type'      => \App\Enum\FaseType::PELAKSANAAN,
                    'proker_id' => $proker->id,
                    'satker_id' => $proker->satker_id
                ]);
                $fase->addDocument(base_path('resources/assets/files/sample.doc'));
                $fase->addDocument(base_path('resources/assets/files/sample.pdf'));

                $fase = factory(\App\Entities\Fase::class)->create([
                    'type'      => \App\Enum\FaseType::PENGAWASAN,
                    'proker_id' => $proker->id,
                    'satker_id' => $proker->satker_id
                ]);
                $fase->addDocument(base_path('resources/assets/files/sample.doc'));
                $fase->addDocument(base_path('resources/assets/files/sample.pdf'));

                $proker->current_fase_id = $fase->id;
                $proker->save();
            });
        });
        $this->command->info('Finish Seed Satker, ProgramKerja, and Fase');

        $this->command->info('Start Seed ProgramKerjaUsulan');
        factory(\App\Entities\ProgramKerjaUsulan::class, 50)->create()->each(function ($model) {
            $model->addDocument(base_path('resources/assets/files/sample.doc'));
            $model->addDocument(base_path('resources/assets/files/sample.pdf'));
        });
        $this->command->info('Finish Seed ProgramKerjaUsulan');

        $this->command->info('Start Seed UjiPublik');
        factory(\App\Entities\UjiPublik::class, 50)->create()->each(function ($model) {
            $model->addDocument(base_path('resources/assets/files/sample.doc'));
            $model->addDocument(base_path('resources/assets/files/sample.pdf'));
        });
        $this->command->info('Finish Seed UjiPublik');

        Model::reguard();
    }
}
