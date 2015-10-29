<?php
namespace Laravolt\Trail\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravolt\Trail\Models\Revision;

trait HasRevisionsTrait
{

    protected $responsibleUser = null;

    public static function bootHasRevisionsTrait()
    {
        static::created('Laravolt\Trail\Contracts\Listener@onCreated');
        static::updated('Laravolt\Trail\Contracts\Listener@onUpdated');
        static::deleted('Laravolt\Trail\Contracts\Listener@onDeleted');

        if (method_exists(get_called_class(), 'restored')) {
            static::restored('Laravolt\Trail\Contracts\Listener@onRestored');
        }
    }

    /**
     * @return mixed
     */
    public function revisions()
    {
        return $this->morphMany(Revision::class, 'revisionable');
    }

    public function getTypeForHuman()
    {
        if (property_exists($this, 'typeForHuman')) {
            return $this->typeForHuman;
        }

        return (new \ReflectionClass($this))->getShortName();
    }

    public function setResponsibleUser(Model $user)
    {
        $this->responsibleUser = $user;
        return $this;
    }

    public function getResponsibleUser()
    {
        return $this->responsibleUser;
    }

    public function getNewAttributes()
    {
        $attributes = $this->getRevisionableItems($this->attributes);

        return $this->prepareAttributes($attributes);
    }

    public function getOldAttributes()
    {
        $attributes = $this->getRevisionableItems($this->original);

        return $this->prepareAttributes($attributes);
    }

    protected function getRevisionableItems(array $values)
    {
        if (count($this->getKeepRevision()) > 0) {
            return array_intersect_key($values, array_flip($this->getKeepRevision()));
        }

        return array_diff_key($values, array_flip($this->getIgnoreRevision()));
    }

    protected function getKeepRevision()
    {
        if (property_exists($this, 'keepRevision')) {
            return $this->keepRevision;
        }

        return [];
    }

    protected function getIgnoreRevision()
    {
        $defaults = [$this->getCreatedAtColumn(), $this->getUpdatedAtColumn()];

        if ($this instanceof SoftDeletes) {
            $defaults[] = $this->getDeletedAtColumn();
        }

        $ignoreRevision = [];
        if (property_exists($this, 'ignoreRevision')) {
            $ignoreRevision = $this->ignoreRevision;
        }

        return array_merge($ignoreRevision, $defaults);
    }

    /**
     * Stringify revisionable attributes.
     *
     * @param  array  $attributes
     * @return array
     */
    protected function prepareAttributes(array $attributes)
    {
        return array_map(function ($attribute) {
            return ($attribute instanceof \DateTime)
                ? $this->fromDateTime($attribute)
                : (string) $attribute;
        }, $attributes);
    }
}

