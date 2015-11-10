<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UjiPublik extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'uji_publik';

    protected $fillable = [];

}
