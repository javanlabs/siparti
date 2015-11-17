<?php

namespace Laravolt\Acl\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;
use Laravolt\Acl\Models\Permission;

class SyncPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'acl:sync-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize permission table and config file';

    protected $config;

    /**
     * Create a new command instance.
     *
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        parent::__construct();

        $this->config = $config;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Synchronize Permissions Entries');

        $permissions = $this->config->get('acl.permissions');

        $items = collect();
        foreach ($permissions as $name) {
            $permission = Permission::firstOrNew(['name' => $name]);
            $status = 'No Change';

            if (!$permission->exists) {
                $permission->save();
                $status = 'New';
            }

            $items->push(['id' => $permission->getKey(), 'name' => $name, 'status' => $status]);
        }

        $items = $items->sortBy('id');

        $this->table(['ID', 'Name', 'Status'], $items);

    }
}
