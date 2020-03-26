<div id="div_11">
<form action="{{url('/article/list')}}"method="get">
	文章标题<input type="text" name="name"placeholder="请输入文章标题" value="{{$query['name']??''}}">
	文章分类<select name="c_id">
				<option value="">--请选择--</option>
				<option value="议论">议论</option>
				<option value="说明">说明</option>
			</select>
	<input type="submit" value="搜索">
</form>
<table>
	<tr>
		<td>文章名称</td>
		<td>文章分类</td>
		<td>文章重要性</td>
		<td>是否显示</td>
		<td>文章作者</td>
		<td>文章照片</td>
		<td>编辑</td>
	</tr>
	<tbody>
	@foreach ($ret as $v)
	<tr>
		<td>{{$v->name}}</td>
		<td>{{$v->c_id}}</td>
		<td>{{$v->radio}}</td>
		<td>{{$v->show}}</td>
		<td>{{$v->man}}</td>
		<td>@if($v->img)<img src="{{env('UPLOADS_URL')}}{{$v->img}}"width="50"height="35">@endif</td>
		<td><a href="java" data-id="{{$v->id}}"id="delete">删除</a>
			<a href="{{url('/article/update'.$v->id)}}">修改</a></td>
	</tr>
	@endforeach
	<td colspan="6">{{$ret->appends($query)->links()}}</td>
		
	
</tbody>
</table>
</div>
<link rel="stylesheet" href="{{asset('/static/admin/css/bootstrap.min.css')}}">
<script src="/static/admin/js/jquery.min.js"></script>
<script src="/static/admin/js/bootstrap.min.js"></script>
<script>
	$("#delete").click(function(){
		var id=$(this).attr('data-id');
		if(confirm('确定删除？')){
			$.get('/article/delete'+id,function(result){
				if(result.code='00000'){
					location.reload();
				}
			},'json')
		}
		return false;
	});
	$(document).on('click','.pagination a',function(){
		var url=$(this).attr('href');
		$.get(url,function(result){
			$('#div_11').html(result);
		});
		return false;
	});
</script>
</div>