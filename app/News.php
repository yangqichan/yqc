<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class News extends Model{
	protected $table='news';
	protected $primarykey='id';
	public $timestamps=false;
	protected $guaarded=[];
}
?>