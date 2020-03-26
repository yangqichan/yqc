<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Books as BooksModel;
use DB;
use App\Article as ArticleModel;
class Article extends Controller{
	public function index(){
		//session(['adminuser'=>null]);
		return view('/article/index');
	}
	public function insert(Request $request){
		$validatedData=$request->validate([
			'name'=>'required|unique:article|regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u',
			'man'=>'required',
			'c_id'=>'required',
			'show'=>'required',
			'radio'=>'required'
		],[
			'name.required'=>'文章标题不能为空',
			'name.unique'=>'文章标题已存在',
			'name.regex'=>'文章标题必须是中文字母数字下划线组成，',
			'c_id.required'=>'文章分类不能为空',
			'show.required'=>'文章重要性不能为空',
			'radio.required'=>'是否显示不能为空',

		]);
		$rets=$request->all();
		dd($rets);
		$post=$request->except('_token');
		if($request->hasFile('img')){
			$post['img']=$this->upload('img');
		}
		$ret=ArticleModel::insert($post);
		if($ret){
			return redirect('/article/list');
		}
	}
	public function list(){
		$name=request()->name;
		$c_id=request()->c_id;
		$where=[];
		if($name){
			$where[]=['name','like',"%$name%"];
		}
		if($c_id){
			$where[]=['c_id','like',"%$c_id%"];
		}
		$pagiSize=config('app.pagiSize');
		$ret=ArticleModel::where($where)->orderby('id','desc')->paginate(2);
		$query=request()->all();
		if(request()->ajax()){
			return view('/article/list',['ret'=>$ret,'query'=>$query]);
		}
		return view('/article/list',['ret'=>$ret,'query'=>$query]);
	}
	public function upload($img){
		if(request()->file($img)->isValid()){
			$file=request()->$img;
			$store_result=$file->store('uploads');
			return $store_result;
		}
		exit('文件上传失败');
	}
	public function delete($id){
		$ret=ArticleModel::destroy($id);
		if($ret){
			if(request()->ajax()){
				return json_encode(['code'=>'00000','msg'=>'删除成功']);
			}
			return redirect('/article/index');
		}
	}
}