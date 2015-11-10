<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProgramKerjaUsulan extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'program_kerja_usulan';

    protected $fillable = [];

}
