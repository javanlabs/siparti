<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;

class Satker extends Model implements Transformable, Presentable
{
    use TransformableTrait;
    use PresentableTrait;

    protected $table = 'satker';

    protected $fillable = ['name'];

}
