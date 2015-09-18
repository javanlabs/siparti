<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['bio', 'timezone'];
}
