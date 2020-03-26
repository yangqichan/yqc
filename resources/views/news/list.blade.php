<div id="div_11">
<form action="{{url('/news/list')}}"method="get">
	新闻名称<input type="text" name="name"placeholder="请输入新闻标题" value="{{$query['name']??''}}">
	新闻作者<input type="text" name="man"placeholder="请输入新闻作者" value="{{$query['man']??''}}">
	<input type="submit" value="搜索">
</form>
<table>
	<tr>
		<td>新闻标题</td>
		<td>新闻作者</td>
		<td>新闻分类</td>
		<td>发布时间</td>
		<td>编辑</td>
	</tr>
	<div id="div_1">
	@foreach ($goods as $v)
	<tr>
		<td>{{$v->name}}</td>
		<td>{{$v->man}}</td>
		<td>{{$v->news_name}}</td>
		<td>{{$v->time}}</td>
		<td><a href="{{url('/news/delete'.$v->id)}}">删除</a>
			<a href="{{url('/news/update'.$v->id)}}">修改</a></td>
	</tr>
	@endforeach
	<td colspan="6">{{$goods->appends($query)->links()}}</td>
	</div>
</table>
<link rel="stylesheet" href="{{asset('/static/admin/css/bootstrap.min.css')}}">
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/admin/js/bootstrap.min.js"></script>
<script>
	$(document).on('click','.pagination a',function(){
		var url=$(this).attr('href');
		$.get(url,function(result){
			$('#div_11').html(result);
		});
		return false;
	});
</script>
</div>