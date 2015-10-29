<?php namespace Laravolt\Trail;

use Illuminate\Auth\Guard;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Trail\Contracts\Listener as ListenerContract;
use Laravolt\Trail\Models\Revision;
use Laravolt\Trail\Traits\HasRevisions;

class Listener implements ListenerContract
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Model $model
     * @return null
     */
    public function onCreated(Model $model)
    {
        return $this->log('create', $model);
    }

    /**
     * @param Model $model
     * @return null
     */
    public function onUpdated(Model $model)
    {
        return $this->log('update', $model);
    }

    /**
     * @param Model $model
     * @return null
     */
    public function onDeleted(Model $model)
    {
        return $this->log('delete', $model);
    }

    /**
     * @param Model $model
     * @return null
     */
    public function onRestored(Model $model)
    {
        return $this->log('restore', $model);
    }

    protected function log($action, $model)
    {
        $revision = new Revision();
        $revision->user_id = $this->getUserIdentifier($model);
        $revision->action = $action;

        $revision->new = $revision->old = [];

        switch ($action) {
            case 'create':
                $revision->new = $model->getNewAttributes();
                break;
            case 'delete':
                $revision->old = $model->getOldAttributes();
                break;
            case 'update':
                $revision->old = $model->getOldAttributes();
                $revision->new = $model->getNewAttributes();
                break;
        }

        return $model->revisions()->save($revision);
    }

    protected function getUserIdentifier($model)
    {
        if ($user = $model->getResponsibleUser()) {
            return $user->getKey();
        }

        return $this->auth->id();
    }
}
