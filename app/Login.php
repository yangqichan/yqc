<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Login extends Model{
	protected $table='login';
	protected $primaryKey='user_id';
	public $timestamps=false;
	protected $guaarded=[];
}
?>