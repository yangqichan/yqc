<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Housing as Hou;
use App\Goods as GoodsModel;
use DB;
class Goods extends Controller{
	public function index(){
		
		$ret=Category::all();
		return view('/goods/index',['ret'=>$ret]);
	}
	public function insert(Request $request){
		$validatedData = $request->validate([
            'goods_name' => 'required|unique:goods|between:2,50',
            'goods_desc' => 'required',//非空
            'cate_id'=> 'required',
            'goods_price'=> 'required|digits:4',
            'goods_num'=> 'required|digits_between:0,8',
        	'goods_number'=>'unique:goods',
        ],[
            'goods_name.required'=>'商品名称必填！',
            'goods_name.unique'=>'商品名称已经存在！',//唯一
            'goods_name.between'=>'商品名称必须在2到50位之间！',//between几位到几位之间
            'goods_desc.required'=>'商品品牌不能为空！',
            'goods_number.unique'=>'定单号不能重复！',
            'cate_id.required'=>'商品分类不能为空！',
            'goods_price.required'=>'价格不能为空！',
            'goods_num.required'=>'库存不能为空！',
            'goods_pirce.digits'=>'价格必须为数字',
            'goods_num.digits_between'=>'商品数量必须在8位以内',

        ]);
		$post=$request->except('_token');	
		if($request->hasFile('goods_img')){
			$post['goods_img']=$this->upload('goods_img');
		}
		if($request->hasFile('goods_imgs')){
			$imgs=$this->Moreupload('goods_imgs');
			$post['goods_imgs']=implode('|',$imgs);
		}
		$ret=GoodsModel::insert($post);
		if($ret){
			 return redirect('/goods/list');
		}

	}
	public function list(){
		$goods_name=request()->goods_name;
		$goods_desc=request()->goods_desc;
		$where=[];
		if($goods_name){
			$where[]=['goods_name','like',"%$goods_name%"];
		}
		if($goods_desc){
			$where[]=['goods_desc','like',"%$goods_desc%"];
		}
		$pagiSize=config('app.pagiSize');
		$ret=GoodsModel::where($where)->orderby('goods_id','desc')->all();
		$query=request()->all();
		return view('/goods/list',['ret'=>$ret,'query'=>$query]);
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