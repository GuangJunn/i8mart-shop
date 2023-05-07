<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    
    //
    protected $fillable = ['name','code','email','address','phone','note','payment_method','total','status'];
}
