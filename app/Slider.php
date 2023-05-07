<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    //
    protected $fillable = [
        'name', 'image', 'user_id',
    ];

    function user(){
        return $this->belongsTo('App\User');
    }
}
