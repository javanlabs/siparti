<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;
use App\Entities\User;

class Activity extends Model implements Transformable, Presentable
{
    use TransformableTrait;
    use PresentableTrait;

    protected $fillable = [];
    
    protected $table = "activity_log";
    
    public function getUserName()
    {
        
        if (is_null($this->user_id)) {
            
            return "Anonymous";
        
        } else {
            
            $user = User::find($this->user_id);
            
            return $user->name;
        }
    }
    
    public function getUserEmail()
    {
        if (is_null($this->user_id)) {
        
            return "Anonymous";
        
        } else {
        
            $user = User::find($this->user_id);
        
            return $user->email;
        }
    }
    
    public function user()
    {
        return $this->belongsTo('App\Entities\User');
    }
}
