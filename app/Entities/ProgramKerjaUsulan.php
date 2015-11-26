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
use App\Entities\ProgramKerja;

class ProgramKerjaUsulan extends Model implements Presentable, Commentable, HasMedia
{
    use PresentableTrait, CommentableTrait, Voteable, Eloquence, HasMediaTrait, HasRevisionsTrait, SoftDeletes;

    protected $table = 'usulan';

    protected $with = ['voteCounter'];

    protected $fillable = ['name', 'manfaat', 'lokasi', 'target', 'instansi_stakeholder', 'description'];

    function __toString()
    {
        return $this->name;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function programKerja()
    {
        return $this->belongsToMany(ProgramKerja::class, 'program_kerja_usulan', 'usulan_id', 'program_kerja_id')->withTimestamps();
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
