<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
      //指定表名
    protected $table = 'cart';
    protected $primaryKey = 'cart_id';
    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
