<form action="{{url('/goods/list')}}"method="get">
	商品名称<input type="text" name="name"placeholder="请输入商品名称" value="{{$query['goods_name']??''}}">
	商品品牌<input type="text" name="man"placeholder="请输入商品品牌名称" value="{{$query['goods_desc']??''}}">
	<input type="submit" value="搜索">
</form>
<table>
	<tr>
		<td>商品名称</td>
		<td>商品品牌</td>
		<td>商品分类</td>
		<td>商品价格</td>
		<td>商品数量</td>
		<td>是否显示</td>
		<td>是否新品</td>
		<td>是否精品</td>
		<td>商品图片</td>
		<td>商品相册</td>
		<td>商品详情</td>
		<td>商品货号</td>
		<td>编辑</td>
	</tr>
	@foreach ($ret as $v)
	<tr>
		<td>{{$v->goods_name}}</td>
		<td>{{$v->goods_desc}}</td>
		<td>{{$v->cate_id}}</td>
		<td>{{$v->goods_price}}</td>
		<td>{{$v->goods_num}}</td>
		<td>{{$v->goods_show=='1' ? '是' :'否'}}</td>
		<td>{{$v->goods_new=='1' ? '是' :'否'}}</td>
		<td>{{$v->goods_best=='1' ? '是' :'否'}}</td>
		<td>@if($v->goods_img)
			<img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}"width="50px" height="35px">
			@endif</td>
		<td>@if($v->goods_imgs)
			@php $goods_imgs=explode('|',$v->goods_imgs);@endphp
			@foreach ($goods_imgs as $vv)<img src="{{env('UPLOADS_URL')}}{{$vv}}"width="50px" height="35px">
			@endforeach
			@endif</td>
		<td>{{$v->goods_details}}</td>
		<td>{{$v->goods_number}}</td>
		<td><a href="{{url('/housing/delete')}}">删除</a>
			<a href="{{url('/housing/update')}}">编辑</a></td>
	</tr>
	@endforeach
</table>
{{$ret->appends($query)->links()}}