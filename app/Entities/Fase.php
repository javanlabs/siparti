<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Fase extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'fase';

    protected $fillable = ['description', 'scope', 'instansi_terkait', 'start_date', 'end_date', 'progress', 'kendala', 'type', 'pic', 'target', 'pagu'];

}
