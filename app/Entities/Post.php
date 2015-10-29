<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Mural\CommentableTrait;
use Laravolt\Mural\Contracts\Commentable;
use Laravolt\Trail\Traits\HasRevisionsTrait;
use Laravolt\Votee\Traits\Voteable;

class Post extends Model implements Commentable
{
    use CommentableTrait, Voteable, HasRevisionsTrait;

    protected $fillable = ['title', 'content'];

    public function getCommentableTitleAttribute()
    {
        return $this->title;
    }

    public function getCommentablePermalinkAttribute()
    {
        return url('posts/' . $this->id);
    }

    function __toString()
    {
        return $this->title;
    }


}
