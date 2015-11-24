<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;

class ProgramKerja extends Model implements Presentable
{
    use PresentableTrait;

    protected $table = 'program_kerja';

    protected $fillable = ['name'];

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
}
