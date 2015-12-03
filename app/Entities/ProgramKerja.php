<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravolt\Trail\Traits\HasRevisionsTrait;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;
use App\Entities\ProgramKerjaDanUsulanRelation;
use App\Enum\FaseType;

class ProgramKerja extends Model implements Presentable
{
    use PresentableTrait, HasRevisionsTrait, SoftDeletes;

    protected $table = 'program_kerja';

    protected $fillable = ['name', 'satker_id', 'creator_id'];

    function __toString()
    {
        return $this->name;
    }

    public function fase()
    {
        return $this->hasMany(Fase::class, 'proker_id');
    }

    public function faseSekarang()
    {
        return $this->belongsTo(Fase::class, 'current_fase_id');
    }

    public function usulan()
    {
        return $this->belongsToMany(ProgramKerjaUsulan::class, 'program_kerja_usulan', 'program_kerja_id', 'usulan_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'satker_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getCurrentFase()
    {
        if (is_null($this->current_fase_id)) {

            return null;

        }

        return (new FaseType($this->faseSekarang->type))->label();
    }
}
