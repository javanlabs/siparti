<?php

namespace App\Entities;

use Laravolt\Mural\Comment;
use Sofa\Eloquence\Eloquence;

class Comments extends Comment
{
    use Eloquence;

    protected $searchableColumns = ['body', 'author.name'];

    protected $table = "comments";
}
