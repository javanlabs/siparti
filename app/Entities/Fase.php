<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;

class Fase extends Model implements Presentable
{
    use PresentableTrait;

    protected $table = 'fase';

    protected $fillable = ['description', 'scope', 'instansi_terkait', 'start_date', 'end_date', 'progress', 'kendala', 'type', 'pic', 'target', 'pagu'];

    protected $dates = ['start_date', 'end_date'];

    public function programKerja()
    {
        return $this->belongsTo(ProgramKerja::class, 'proker_id');
    }
}
