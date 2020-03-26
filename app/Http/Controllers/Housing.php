<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Housing as Hou;
use DB;
class Housing extends Controller{
	public function index(){
		return view('/housing/index');
	}
	public function insert(Request $request){
		$post=$request->except('_token');	
		if($request->hasFile('img')){
			$post['img']=$this->upload('img');
		}
		if($request->hasFile('imgs')){
			$imgs=$this->Moreupload('imgs');
			$post['imgs']=implode('|',$imgs);
		}
		$ret=Hou::insert($post);
		if($ret){
			 return redirect('/housing/list');
		}

	}
	public function list(){
		$name=request()->name;
		$man=request()->man;
		$where=[];
		if($name){
			$where[]=['name','like',"%$name%"];
		}
		if($man){
			$where[]=['man','like',"%$man%"];
		}
		$pagiSize=config('app.pagiSize');
		$ret=Hou::where($where)->orderby('id','desc')->paginate(2);
		$query=request()->all();
		return view('/housing/list',['ret'=>$ret,'query'=>$query]);
	}
	public function upload($img){
		if(request()->file($img)->isValid()){
			$file=request()->$img;
			$store_result=$file->store('uploads');
			return $store_result;
		}
		exit('上传文件出错');
	}
	public function Moreupload($img){
		$file=request()->$img;
		foreach($file as $k=>$v){
			if($v->isValid()){
				$store_result[$k]=$v->store('uploads');
			}else{
				$store_result[$k]='文件上传出错';
			}
		}
		return $store_result;
	}
}

?>