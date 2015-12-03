<?php

namespace App\Console\Commands;

use App\Entities\User;
use App\Enum\UserStatus;
use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'siparti:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup many thing on first use';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Refresh migration');
        $this->call('migrate:refresh');

        $this->info('Seed permission data');
        $this->call('acl:sync-permission');

        $this->info('Create root account');
        User::create([
            'name'     => 'root',
            'email'    => $this->ask('Email', 'root@siparti.com'),
            'password' => bcrypt($this->ask('Password', 'password')),
            'status'   => UserStatus::ACTIVE,
        ]);

        if(app()->environment() == 'development') {
            if ($this->confirm('Seed sample data ?', true)) {
                $this->call('db:seed');
            }
        }
    }
}
