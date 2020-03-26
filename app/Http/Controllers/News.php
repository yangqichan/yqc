<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\News as NewsModel;
use App\Http\Requests\StoreBrandPost;
use Validator;
use DB;
class News extends Controller{
	public function index(){
		session(['name'=>'嘿嘿嘿']);
		request()->session()->put('number',100);
		//session(['name'=>null]);
		//request()->session()->forget('number');
		dump(request()->session()->all());
		echo request()->session()->get('number');
		$ret=DB::table('news_id')->get();
		return view('/news/index',['ret'=>$ret]);
	}
	public function insert(Request $request){
		$validatedData=$request->validate([
			'name'=>'required|unique:news|regex:/^[\x{4e00}-\x{9fa5}\w]{2,30}$/u',
			'man'=>'required',
		],[
			'name.required'=>'新闻标题不能为空',
			'name.unique'=>'新闻标题已存在',
			'name.regex'=>'新闻标题必须由中文数字字母下划线组成必须在2到15之间',
			'man.required'=>'新闻作者必须填写',
		]);
		$post=$request->except('_token');
		$ret=NewsModel::insert($post);
		if($ret){
			return redirect('/news/list');
		}
	}
	public function list(){
		$page=request()->page??1;	
		//dd($goods);
		$name=request()->name??'';
		$man=request()->man??'';
		$goods=Redis::get('goodslist_'.$page.'_'.$name.'_'.$man);
		if(!$goods){
			echo '123';
			$where=[];
			if($name){
				$where[]=['name','like',"%$name%"];
			}
			if($man){
				$where[]=['man','like',"%$man%"];
			}
			$pagiSize=config('app.pagiSize');
			$goods=NewsModel::select('news.*','news_id.news_name')->leftjoin('news_id','news.news_id','=','news_id.news_id')->where($where)->orderby('id','asc')->paginate(2);
			
			$goods=serialize($goods);
			Redis::setex('goodslist_'.$page.'_'.$name.'_'.$man,5*60,$goods);
		}
		$goods=unserialize($goods);
		$query=request()->all();
		return view('/news/list',['goods'=>$goods,'query'=>$query]);
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