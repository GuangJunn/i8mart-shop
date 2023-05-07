<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListImage extends Model
{
    //
    protected $fillable = ['name','imagedesc','product_id'];

    function product(){
        return $this->hasMany('App\Product');
    }
}
