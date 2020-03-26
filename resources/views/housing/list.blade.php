<form action="{{url('/housing/list')}}"method="get">
	小区名称<input type="text" name="name"placeholder="请输入小区名称" value="{{$query['name']??''}}">
	导购人<input type="text" name="man"placeholder="请输入导购人名称" value="{{$query['man']??''}}">
	<input type="submit" value="搜索">
</form>
<table>
	<tr>
		<td>小区名称</td>
		<td>导购人</td>
		<td>导购人电话</td>
		<td>房屋面积</td>
		<td>房屋图片</td>
		<td>房屋相册</td>
		<td>售价</td>
		<td>编辑</td>
	</tr>
	@foreach ($ret as $v)
	<tr>
		<td>{{$v->name}}</td>
		<td>{{$v->man}}</td>
		<td>{{$v->tel}}</td>
		<td>{{$v->mj}}</td>
		<td>@if($v->img)
			<img src="{{env('UPLOADS_URL')}}{{$v->img}}"width="50px" height="35px">
			@endif</td>
		<td>@if($v->imgs)
			@php $imgs=explode('|',$v->imgs);@endphp
			@foreach ($imgs as $vv)<img src="{{env('UPLOADS_URL')}}{{$vv}}"width="50px" height="35px">
			@endforeach
			@endif</td>
		<td>{{$v->price}}</td>
		<td><a href="{{url('/housing/delete')}}">删除</a>
			<a href="{{url('/housing/update')}}">编辑</a></td>
	</tr>
	@endforeach
</table>
{{$ret->appends($query)->links()}}