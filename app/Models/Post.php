<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Mural\CommentableTrait;
use Laravolt\Mural\Contracts\Commentable;

class Post extends Model implements Commentable
{
    use CommentableTrait;

    public function getCommentablePermalinkAttribute()
    {
        return url('posts/' . $this->id);
    }
}
