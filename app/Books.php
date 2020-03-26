<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Books extends Model{
	protected $table='books';
	protected $primarykey='id';
	public $timestamps=false;
	protected $guaarded=[];
}
?>