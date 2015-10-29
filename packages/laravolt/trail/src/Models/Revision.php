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
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(config('auth.model'));
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
        return $diff;
    }
}
