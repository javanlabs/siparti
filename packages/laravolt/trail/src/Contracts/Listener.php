<?php namespace Laravolt\Trail\Contracts;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Trail\Traits\HasRevisions;

interface Listener
{
    /**
     * @param Model $model
     * @return null
     */
    public function onCreated(Model $model);

    /**
     * @param Model $model
     * @return null
     */
    public function onUpdated(Model $model);

    /**
     * @param Model $model
     * @return null
     */
    public function onDeleted(Model $model);

    /**
     * @param Model $model
     * @return null
     */
    public function onRestored(Model $model);
}
