<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Mural\CommentableTrait;
use Laravolt\Mural\Contracts\Commentable;
use Laravolt\Votee\Traits\Voteable;
use Sofa\Revisionable\Laravel\RevisionableTrait;
use Sofa\Revisionable\Revisionable;

class Post extends Model implements Commentable, Revisionable
{
    use CommentableTrait, Voteable, RevisionableTrait;

    protected $fillable = ['title', 'content'];

    public function getCommentableTitleAttribute()
    {
        return $this->title;
    }

    public function getCommentablePermalinkAttribute()
    {
        return url('posts/' . $this->id);
    }
}
