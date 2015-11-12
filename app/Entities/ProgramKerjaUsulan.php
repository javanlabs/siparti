<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class ProgramKerjaUsulan extends Model implements Transformable, HasMedia
{
    use TransformableTrait;
    use HasMediaTrait;

    protected $table = 'program_kerja_usulan';

    protected $fillable = [
		'name',
    	'creatorId',
    	'instansi_stakeHolder',
    	'deleted_at',
    	'create_at',
    	'update_at'
	];

}
