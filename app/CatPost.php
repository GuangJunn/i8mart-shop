<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatPost extends Model
{
    use SoftDeletes;
    //
    protected $fillable = ['title','slug','parent_id'];

    function post(){
        return $this->hasMany('App\Post');
    }
}
