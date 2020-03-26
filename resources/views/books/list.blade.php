<form action="{{url('/books/list')}}"method="get">
	图书名称<input type="text" name="name"placeholder="请输入图书名称" value="{{$query['name']??''}}">
	图书作者<input type="text" name="man"placeholder="请输入图书作者" value="{{$query['man']??''}}">
	<input type="submit" value="搜索">
</form>
<table border="1">
	<tr>
		<td>图书名称</td>
		<td>图书作者</td>
		<td>图书价格</td>
		<td>图书照片</td>
		<td>编辑</td>
	</tr>
	<tbody>
	@foreach ($ret as $v)
	<tr>
		<td>{{$v->name}}</td>
		<td>{{$v->man}}</td>
		<td>{{$v->price}}</td>
		<td>@if($v->img)<img src="{{env('UPLOADS_URL')}}{{$v->img}}"width="50"height="35">@endif</td>
		<td><a href="{{url('/delete'.$v->id)}}">删除</a>
			<a href="{{url('/update'.$v->id)}}">修改</a></td>
	</tr>
	@endforeach
	
		
	
</tbody>
</table>
<td colspan="6">{{$ret->appends($query)->links()}}</td>