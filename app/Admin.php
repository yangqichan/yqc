<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table='admin_man';
	protected $primarykey='admin_id';
	public $timestamps=false;
	protected $guaarded=[];
}
