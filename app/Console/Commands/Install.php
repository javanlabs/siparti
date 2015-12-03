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

        $this->info('Create root account');
        User::create([
            'name'     => 'root',
            'email'    => $this->ask('Email'),
            'password' => $this->secret('Password'),
            'status'   => UserStatus::ACTIVE,
        ]);
    }
}
