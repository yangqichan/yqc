<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Shop_goods extends Model{
	protected $table='Shop_goods';
	protected $primaryKey='goods_id';
	public $timestamps=false;
	protected $guaarded=[];
}
?>