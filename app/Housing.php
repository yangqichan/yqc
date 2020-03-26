<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Housing extends Model{
	protected $table='housing';
	protected $primaryKey='id';
	public $timestamps=false;
	protected $guaarded=[];
}
?>