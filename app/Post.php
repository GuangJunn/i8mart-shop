<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'image','name','desc','content','cat_post_id','user_id','slug'
    ];

    function catpost(){
        return $this->belongsTo('App\CatPost');
    }

    function user(){
        return $this->belongsTo('App\User');
    }
}
