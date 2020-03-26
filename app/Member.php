<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
     //指定表名
    protected $table = 'member';
    protected $primaryKey = 'member_id';
    public $timestamps = false;
    //黑名单
    protected $guarded = [];
}
