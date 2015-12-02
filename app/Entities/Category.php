<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;

class Category extends Model implements Transformable, Presentable
{
    use TransformableTrait;
    use PresentableTrait;

    protected $nullable = ['parent_id'];

    protected $table = 'category';

    protected $fillable = ['id','name','parent_id', 'status'];

    public $timestamps = false;

    public function programKerja()
    {
        return $this->hasMany(ProgramKerja::class, 'category_id');
    }

}
