<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Goods_man extends Model{
	protected $table='goods_man';
	protected $primarykey='id';
	public $timestamps=false;
	protected $guaarded=[];
}
?>