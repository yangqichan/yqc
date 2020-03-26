<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use DB;
class IndexController extends Controller{
	public function add(){
		return view('add');
	}
	public function adddo(){
		echo request()->name;
	}
	public function indexx(){
		return view('indexx');
	}
	public function register(Request $request){
		$post=$request->except('_token');
		if($request->hasFile('img')){
			$img=$this->upload('img');
		}
		$varchar=$_POST['varchar'];
		$sex=$_POST['sex'];
		$name=$_POST['name'];
		$ret=DB::table('yqc')->insert([['name'=>$name,'sex'=>$sex,'varchar'=>$varchar,'img'=>$img]]);
		if($ret){
			return redirect('/list');
		}
	}
	
	public function list(){
		$pageSize=config('app.pagiSize');
		$ret=DB::table('yqc')->paginate(4);
		return view('list',['ret'=>$ret]);
	}
	public function update($id){
		$ret=DB::table('yqc')->where('id',$id)->first();
		return view('brand/update',['ret'=>$ret]);	
	}
	public function updates(Request $request,$id){
		$post=$request->except('_token');
		if($request->hasFile('img')){
			$img=$this->upload('img');
		}
		$ret=DB::table('yqc')->where('id',$id)->update(['img'=>$img]);
		if($ret){
			return redirect('/list');
		}
	}
	public function delete($id){
		$ret=DB::table('yqc')->where('id',$id)->delete();
		if($ret){
			return redirect('/list');
		}
	}
	public function index(){
		$ret=Category::all();
		return view('/category/index',['ret'=>$ret]);
	}
	public function insert(Request $request){
		$cate_show=$_POST['cate_show'];
		$cate_name=$_POST['cate_name'];
		$pid=$_POST['pid'];
		$content=$_POST['content'];
		$post=[['cate_name'=>$cate_name,'cate_show'=>$cate_show,'pid'=>$pid,'content'=>$content]];
		$ret=Category::insert($post);
		if($ret){
			return redirect('/category/list');
		}
	}

	public function lists(){
		$pageSize=config('app.pagiSize');
		$ret=Category::paginate(4);
		return view('category/list',['ret'=>$ret]);
	}
	public function deletes($id){
		$ret=Category::where('cate_id',$id)->delete();
		if($ret){
			return redirect('/category/list');
		}
	}
	public function upda($id){
		$ret=Category::where('cate_id',$id)->first();
		$arr=Category::all();
		return view('category/update',['ret'=>$ret,'arr'=>$arr]);
	}
	public function updas(Request $request,$id){
		$post=$request->except('_token');
		$cate_name=$_POST['cate_name'];
		$cate_show=$_POST['cate_show'];
		$pid=$_POST['pid'];
		$content=$_POST['content'];
		$ret=Category::where('cate_id',$id)->update($post);
		if($ret){
			return redirect('/category/list');
		}
	}
	public function upload($img){
		if(request()->file($img)->isValid()){
			$file=request()->$img;
			$store_result=$file->store('uploads');
			return $store_result;
		}
		exit('上传文件出错');
	}
}
?>