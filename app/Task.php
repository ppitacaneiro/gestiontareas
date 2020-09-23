<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['user_id','name','description','assigned_date'];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }
}
