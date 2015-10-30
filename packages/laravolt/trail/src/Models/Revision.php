<?php

namespace Laravolt\Trail\Models;

use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $casts = [
        'old' => 'array',
        'new' => 'array',
    ];

    public function revisionable()
    {
        return $this->morphTo()->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(config('auth.model'));
    }

    /**
     * Determine whether field was updated during current action.
     *
     * @param  string $key
     * @return boolean
     */
    public function isUpdated($key)
    {
        return in_array($key, $this->getUpdated());
    }

    /**
     * Get array of updated fields.
     *
     * @return array
     */
    public function getUpdated()
    {
        return array_keys(array_diff_assoc($this->new, $this->old));
    }

    /**
     * Get diff of the old/new arrays.
     *
     * @return array
     */
    public function getDiff()
    {
        $diff = [];
        foreach ($this->getUpdated() as $key) {
            $diff[$key]['old'] = array_get($this->old, $key);
            $diff[$key]['new'] = array_get($this->new, $key);
        }

        return $this->formatDiff($diff);
    }

    protected function formatDiff($diff)
    {
        $casts = array_flip($this->revisionable->getRevisionableCasts());

        foreach ($diff as $field => $value) {
            if ($relation = array_search($field, $casts)) {

                $oldRevision = new $this->revisionable;
                $oldRevision->setRawAttributes($this->old);

                $newRevision = new $this->revisionable;
                $newRevision->setRawAttributes($this->new);

                $diff[$field]['old'] = $oldRevision->{$relation};
                $diff[$field]['new'] = $newRevision->{$relation};
            }
        }

        return $diff;
    }
}
