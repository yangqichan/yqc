<form action="{{url('/goods/insert')}}" method="post" enctype="multipart/form-data">
<h1>商品添加</h1>@csrf
商品名称<input type="text" name="goods_name"><b style="color:red">{{$errors->first('goods_name')}}</b><br>
商品品牌<input type="text"name="goods_desc"><b style="color:red">{{$errors->first('goods_desc')}}</b><br>
商品分类<select name="cate_id">
			<option value="">--请选择--</option>
			@foreach ($ret as $v)
			<option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
			@endforeach
	</select><b style="color:red">{{$errors->first('cate_id')}}</b><br>
商品价格<input type="text" name="goods_price"><b style="color:red">{{$errors->first('goods_price')}}</b><br>
商品数量<input type="text"name="goods_num"><b style="color:red">{{$errors->first('goods_num')}}</b><br>
是否显示<input type="radio" name="goods_show"value="1">是
		<input type="radio" name="goods_show"value="2">否<br>
是否新品<input type="radio" name="goods_new" value="1">是
<input type="radio" name="goods_new" value="2">否<br>
是否精品<input type="radio" name="goods_best" value="1">是
<input type="radio" name="goods_best" value="2">否<br>
商品图片<input type="file" name="goods_img"><br>
商品相册<input type="file" name="goods_imgs[]"multiple="multiple"><br>
商品详情<textarea name="goods_details"></textarea><br>
商品货号<input type="text" name="goods_number"><b style="color:red">{{$errors->first('goods_number')}}</b><br>
<input type="submit" value="添加">
</form>