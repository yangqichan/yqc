<form action="{{url('/goods_man/list')}}"method="get">
	管理员名称<input type="text" name="name"placeholder="请输入管理员名称" value="{{$query['name']??''}}">
	<input type="submit" value="搜索">
</form>
<table border="1">
	<tr>
		<td>管理员名称</td>
		<td>管理员密码</td>
		<td>管理员手机号</td>
		<td>管理员邮箱</td>
		<td>管理员照片</td>
		<td>编辑</td>
	</tr>
	<tbody>
	@foreach ($ret as $v)
	<tr>
		<td>{{$v->name}}</td>
		<td>{{$v->psd}}</td>
		<td>{{$v->tel}}</td>
		<td>{{$v->email}}</td>
		<td>@if($v->img)<img src="{{env('UPLOADS_URL')}}{{$v->img}}"width="50"height="35">@endif</td>
		<td><a href="{{url('/delete'.$v->id)}}">删除</a>
			<a href="{{url('/goods_man/upda'.$v->id)}}">修改</a></td>
	</tr>
	@endforeach
	
		
	
</tbody>
</table>
<td colspan="6">{{$ret->appends($query)->links()}}</td>