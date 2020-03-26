<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Books as BooksModel;
use DB;
use Illuminate\Validation\Rule;
use App\Goods_man as Goods_manModel;
class Goods_man extends Controller{
	public function index(){
		return view('/goods_man/index');
	}
	public function insert(Request $request){
		$request->validate([
			'name'=>'required|unique:goods_man|between:2,16|regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u',
			'psd'=>'between:0,6',
			'tel'=>'between:11,11',
			'email'=>'email',
		],[
			'name.required'=>'管理员名称不能为空',
			'name.unique'=>'管理员名称已存在',
			'name.between'=>'管理员名称必须在2到16之间',
			'name.regex'=>'管理员名称必须有中文，数字，字母，下划线，破折号组成',
			'psd.between'=>'密码必须在6位以内',
			'tel.between'=>'手机号必须为11位',
			'email.email'=>'邮箱格式不正确',
		]);
		$post=$request->except('_token');
		if($request->hasFile('img')){
			$post['img']=$this->upload('img');
		}
		$ret=Goods_manModel::insert($post);
		if($ret){
			return redirect('/goods_man/list');
		}
	}
	public function list(){
		$name=request()->name;
		$where=[];
		if($name){
			$where[]=['name','like',"%$name%"];
		}
		$pagiSize=config('app.pagiSize');
		$ret=Goods_manModel::where($where)->orderby('id','asc')->paginate(2);
		$query=request()->all();
		return view('/goods_man/list',['ret'=>$ret,'query'=>$query]);
	}
	public function upda($id){
		$ret=Goods_manmodel::where('id',$id)->first();
		return view('/goods_man/update',['ret'=>$ret]);	
	}
	public function update(Request $request,$id){
		$request->validate([
			'name'=>['required',
				Rule::unique('goods_man')->ignore($id,'id'),
			],
			'psd'=>'between:0,6',
			'tel'=>'between:11,11',
			'email'=>'email',
		],[
			'name.required'=>'管理员名称不能为空',
			'psd.between'=>'密码必须在6位以内',
			'tel.between'=>'手机号必须为11位',
			'email.email'=>'邮箱格式不正确',
		]);
		$post=$request->except('_token');
		if($request->hasFile('img')){
			$post['img']=$this->upload('img');
		}
		$ret=Goods_manmodel::where('id',$id)->update($post);
		if($ret){
			return redirect('/goods_man/list');
		}
	}
	public function upload($img){
		if(request()->file($img)->isValid()){
			$file=request()->$img;
			$store_result=$file->store('uploads');
			return $store_result;
		}
		exit('文件上传失败');
	}
}