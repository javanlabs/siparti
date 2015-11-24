<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravolt\Mural\CommentableTrait;
use Laravolt\Mural\Contracts\Commentable;
use Laravolt\Trail\Traits\HasRevisionsTrait;
use Laravolt\Votee\Traits\Voteable;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;
use Sofa\Eloquence\Eloquence;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class UjiPublik extends Model implements Presentable, Commentable, HasMedia
{
    use PresentableTrait, Eloquence, CommentableTrait, Voteable, HasMediaTrait, HasRevisionsTrait, SoftDeletes;

    protected $table = 'uji_publik';

    protected $fillable = ['name', 'materi'];

    function __toString()
    {
        return $this->name;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function scopeByYear($query, $year)
    {
        if ($year) {
            $query->whereRaw("YEAR(created_at) = $year");
        }

        return $query;
    }

    public function getCommentableTitleAttribute()
    {
        return $ths->name;
    }

    public function getCommentablePermalinkAttribute()
    {
        return $this->present('url');
    }

    public function addDocument($file)
    {
        return $this->addMedia($file)->preservingOriginal()->toCollection();
    }
}
