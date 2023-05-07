<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    //
    protected $fillable = [
        'name','price','image','list_image','desc','content','cat_product_id','status','status_product','slug'
    ];

    function catproduct(){
        return $this->belongsTo('App\CatProduct');
    }
    function listimage(){
        return $this->belongsTo('App\ListImage');
    }
}
