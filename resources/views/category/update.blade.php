<h1>商品分类的修改</h1>
<form action="{{url('category/upda'.$ret->cate_id)}}" method="post">@csrf
分类名称<input type="text" name="cate_name" value="{{$ret->cate_name}}"><br>

是否显示<input type="radio" name="cate_show"value="是"{{$ret->cate_show=='是' ? 'checked':''}}>是
		<input type="radio" name="cate_show"value="否"{{$ret->cate_show=='否' ? 'checked':''}}>否<br>
所属分类<select name="pid">
			<option value="0" {{$ret->pid==0 ? 'selected' :''}}>暂无分类</option>
			@foreach ($arr as $v)
			<option value="{{$v->cate_id}}"{{$ret->pid==$v->cate_id ? 'selected' :''}}>{{$v->cate_name}}</option>
			@endforeach
		</select><br>
分类描述<textarea name="content">{{$ret->content}}</textarea><br>
<input type="submit" value="修改">
</form>
