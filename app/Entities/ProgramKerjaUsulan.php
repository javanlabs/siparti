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

class ProgramKerjaUsulan extends Model implements Presentable, Commentable, HasMedia
{
    use PresentableTrait, CommentableTrait, Voteable, Eloquence, HasMediaTrait;

    protected $table = 'program_kerja_usulan';

    protected $with = ['voteCounter'];

    protected $fillable = ['name', 'manfaat', 'lokasi', 'target', 'instansi_stakeholder', 'description'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function getCommentableTitleAttribute()
    {
        return $this->name;
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
