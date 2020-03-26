<div id="div_1">
<tbody>
	@foreach ($ret as $v)
	<tr>
		<td>{{$v->name}}</td
		<td>{{$v->man}}</td>
		<td>{{$v->news_name}}</td>
		<td>{{$v->time}}</td>
		<td><a href="{{url('/news/delete'.$v->id)}}">删除</a>
			<a href="{{url('/news/update'.$v->id)}}">修改</a></td>
	</tr>
	@endforeach
	<td colspan="6">{{$ret->appends($query)->links()}}</td>
	</tbody>
</div>w