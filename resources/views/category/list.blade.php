<table >
	<tr>
		<td>分类名称</td>
		<td>是否显示</td>
		<td>分类描述</td>
		<td>编辑</td>
	</tr>
	@foreach ($ret as $v)
	<tr>
		<td>{{$v->cate_name}}</td>
		<td>{{$v->cate_show}}</td>
		<td>{{$v->content}}</td>
		<td><a href="{{url('/category/delete'.$v->cate_id)}}">删除</a>
			<a href="{{url('/category/update'.$v->cate_id)}}">编辑</a></td>
	</tr>
	@endforeach
	<td colspan="6">{{$ret->links()}}</td>
</table>