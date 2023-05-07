<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatProduct extends Model
{
    //
    protected $fillable = ['title','slug','parent_id'];

    function product(){
        return $this->hasMany('App\Product');
    }

    public static function recursive ($category, $parents = 0, $level = 1, &$listCategory){
        if(count($category) > 0){
            foreach ($category as $key => $value) {
                if($value->parent_id == $parents){
                    $value-> level = $level;
                    $listCategory[] = $value;
                    unset($category[$key]);

                    $parent = $value->id;

                    self::recursive($category , $parent, $level + 1, $listCategory);

                }
            }
        }
    }

}
