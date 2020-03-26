<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $table='article';
	protected $primarykey='id';
	public $timestamps=false;
	protected $guaarded=[];
}
