<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Mural\CommentableTrait;
use Laravolt\Mural\Contracts\Commentable;
use Laravolt\Votee\Traits\Voteable;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;

class Fase extends Model implements Presentable, Commentable
{
    use PresentableTrait, CommentableTrait, Voteable;

    protected $table = 'fase';

    protected $fillable = ['description', 'scope', 'instansi_terkait', 'start_date', 'end_date', 'progress', 'kendala', 'type', 'pic', 'target', 'pagu'];

    protected $dates = ['start_date', 'end_date'];

    protected $with = ['programKerja', 'satker'];

    public function programKerja()
    {
        return $this->belongsTo(ProgramKerja::class, 'proker_id');
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }

    public function getCommentableTitleAttribute()
    {
        return $this->present('name');
    }

    public function getCommentablePermalinkAttribute()
    {
        return $this->present('url');
    }
}
