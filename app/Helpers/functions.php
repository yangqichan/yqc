<?php
	//引入公共文件
	//文件上传
	function upload($img){
		if(request()->file($img)->isValid()){
				$file=request()->$img;
				$store_result=$file->store('uploads');
				return $store_result;
		}
		exit('上传文件出错');
	}
	//多文件上传
	function Moreupload($img){
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
	function CreateTree($data,$parent_id=0,$level=0){
		if(!$data){
			return;
		}
		static $array=[];
		foreach($data as $v){
			if($v->parent_id==$parent_id){
				$v->level=$level;
				$array[]=$v;
				CreateTree($data,$v->cate_id,$level+1);
			}
		}
		return $array;
	}
?>