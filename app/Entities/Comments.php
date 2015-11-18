<?php

namespace App\Entities;

use Laravolt\Mural\Comment;
use Sofa\Eloquence\Eloquence;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;
use Avatar;


class Comments extends Comment implements Presentable
{
    use Eloquence, PresentableTrait;

    protected $searchableColumns = ['body', 'author.name'];

    protected $table = "comments";

    public function getAvatar()
    {
        return Avatar::create($this->author->name)->toBase64();
    }
}
