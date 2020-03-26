<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Books as BooksModel;
use DB;
class Books extends Controller{
	public function index(){
		return view('/books/index');
	}
	public function insert(Request $request){
		$validatedData=$request->validate([
			'name'=>'required|unique:books|between:2,15',
			'man'=>'required',
		],[
			'name.required'=>'图书名称不能为空',
			'name.unique'=>'图书名称已存在',
			'name.between'=>'图书名称必须在2到15之间',
			'man.required'=>'图书作者必须填写',
		]);
		$post=$request->except('_token');
		if($request->hasFile('img')){
			$post['img']=$this->upload('img');
		}
		$ret=BooksModel::insert($post);
		if($ret){
			return redirect('/books/list');
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
		$ret=BooksModel::where($where)->orderby('id','desc')->paginate(2);
		$query=request()->all();
		return view('/books/list',['ret'=>$ret,'query'=>$query]);
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