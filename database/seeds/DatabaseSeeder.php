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
        \Illuminate\Support\Facades\File::cleanDirectory(config('filesystems.disks.media.root'));
        \Illuminate\Support\Facades\File::cleanDirectory(config('filesystems.disks.document.root'));

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

        auth()->login($user);

        factory(\App\Entities\User::class, 50)->create();

        $this->command->info('Start Seed Satker, ProgramKerja, and Fase');
        factory(\App\Entities\Satker::class, 10)->create()->each(function ($satker) {

            $proker = factory(\App\Entities\ProgramKerja::class, 10)->create(['satker_id' => $satker->id]);
            $proker->each(function ($proker) {
                $fase = factory(\App\Entities\Fase::class)->create([
                    'type'      => \App\Enum\FaseType::PERENCANAAN,
                    'proker_id' => $proker->id,
                    'satker_id' => $proker->satker_id
                ]);
                $fase->addDocument(base_path('resources/assets/files/sample.doc'));
                $fase->addDocument(base_path('resources/assets/files/sample.pdf'));

                foreach(range(1, rand(1, 10)) as $id) {
                    Mural::addComment($fase, Faker\Factory::create()->paragraph, 'default');
                    Votee::voteUp($fase, \App\Entities\User::find($id));
                    Votee::voteDown($fase, \App\Entities\User::find($id + 10));
                }

                $fase = factory(\App\Entities\Fase::class, 'berjalan')->create([
                    'type'      => \App\Enum\FaseType::PELAKSANAAN,
                    'proker_id' => $proker->id,
                    'satker_id' => $proker->satker_id
                ]);
                $fase->addDocument(base_path('resources/assets/files/sample.doc'));
                $fase->addDocument(base_path('resources/assets/files/sample.pdf'));
                foreach(range(1, rand(1, 10)) as $id) {
                    Mural::addComment($fase, Faker\Factory::create()->paragraph, 'default');
                    Votee::voteUp($fase, \App\Entities\User::find($id));
                    Votee::voteDown($fase, \App\Entities\User::find($id + 10));
                }

                $fase = factory(\App\Entities\Fase::class)->create([
                    'type'      => \App\Enum\FaseType::PENGAWASAN,
                    'proker_id' => $proker->id,
                    'satker_id' => $proker->satker_id
                ]);
                $fase->addDocument(base_path('resources/assets/files/sample.doc'));
                $fase->addDocument(base_path('resources/assets/files/sample.pdf'));
                foreach(range(1, rand(1, 10)) as $id) {
                    Mural::addComment($fase, Faker\Factory::create()->paragraph, 'default');
                    Votee::voteUp($fase, \App\Entities\User::find($id));
                    Votee::voteDown($fase, \App\Entities\User::find($id + 10));
                }

                $proker->current_fase_id = $fase->id;
                $proker->save();
            });
        });
        $this->command->info('Finish Seed Satker, ProgramKerja, and Fase');

        $this->command->info('Start Seed ProgramKerjaUsulan');
        factory(\App\Entities\ProgramKerjaUsulan::class, 50)->create()->each(function ($model) {
            $model->addDocument(base_path('resources/assets/files/sample.doc'));
            $model->addDocument(base_path('resources/assets/files/sample.pdf'));

            foreach(range(1, rand(1, 10)) as $id) {
                Mural::addComment($model, Faker\Factory::create()->paragraph, 'default');
                Votee::voteUp($model, \App\Entities\User::find($id));
                Votee::voteDown($model, \App\Entities\User::find($id + 10));
            }

            // realiasasi usulan menjadi program kerja
            $proker = factory(\App\Entities\ProgramKerja::class)->create();
            $fase = factory(\App\Entities\Fase::class)->create([
                'type'      => \App\Enum\FaseType::PERENCANAAN,
                'proker_id' => $proker->id
            ]);
            $fase->addDocument(base_path('resources/assets/files/sample.doc'));
            $fase->addDocument(base_path('resources/assets/files/sample.pdf'));

            foreach(range(1, rand(1, 10)) as $id) {
                Mural::addComment($fase, Faker\Factory::create()->paragraph, 'default');
                Votee::voteUp($fase, \App\Entities\User::find($id));
                Votee::voteDown($fase, \App\Entities\User::find($id + 10));
            }
            $proker->current_fase_id = $fase->id;
            $proker->save();

            $proker->usulan()->attach($model);

        });
        $this->command->info('Finish Seed ProgramKerjaUsulan');

        $this->command->info('Start Seed UjiPublik');
        factory(\App\Entities\UjiPublik::class, 50)->create()->each(function ($model) {
            $model->addDocument(base_path('resources/assets/files/sample.doc'));
            $model->addDocument(base_path('resources/assets/files/sample.pdf'));

            foreach(range(1, rand(1, 10)) as $id) {
                Mural::addComment($model, Faker\Factory::create()->paragraph, 'default');
                Votee::voteUp($model, \App\Entities\User::find($id));
                Votee::voteDown($model, \App\Entities\User::find($id + 10));
            }
        });
        $this->command->info('Finish Seed UjiPublik');

        auth()->logout();
        Model::reguard();
    }
}
