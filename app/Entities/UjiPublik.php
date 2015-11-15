<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Mural\CommentableTrait;
use Laravolt\Mural\Contracts\Commentable;
use Laravolt\Votee\Traits\Voteable;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;
use Sofa\Eloquence\Eloquence;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class UjiPublik extends Model implements Presentable, Commentable, HasMedia
{
    use PresentableTrait, Eloquence, CommentableTrait, Voteable, HasMediaTrait;

    protected $table = 'uji_publik';

    protected $fillable = [];

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
