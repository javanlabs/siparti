<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravolt\Mural\CommentableTrait;
use Laravolt\Mural\Contracts\Commentable;
use Laravolt\Trail\Traits\HasRevisionsTrait;
use Laravolt\Votee\Traits\Voteable;

class Post extends Model implements Commentable
{
    use CommentableTrait, Voteable, HasRevisionsTrait, SoftDeletes;

    protected $fillable = ['title', 'content'];

    protected $revisionableCasts = ['author_id' => 'author'];

    public function author()
    {
        return $this->belongsTo(config('auth.model'), 'author_id');
    }

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

    public function presentRevisionForAuthorId($value)
    {
        return $this->author()->find($value);
    }
}
