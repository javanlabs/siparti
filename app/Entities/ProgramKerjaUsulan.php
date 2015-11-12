<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Mural\CommentableTrait;
use Laravolt\Mural\Contracts\Commentable;
use Laravolt\Votee\Traits\Voteable;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;

class ProgramKerjaUsulan extends Model implements Presentable, Commentable
{
    use PresentableTrait, CommentableTrait, Voteable;

    protected $table = 'program_kerja_usulan';

    protected $with = ['voteCounter'];

    protected $fillable = [];

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


}
