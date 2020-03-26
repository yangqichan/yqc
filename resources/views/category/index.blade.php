<h1>商品分类的添加</h1>
<form action="{{url('insert')}}" method="post">@csrf
分类名称<input type="text" name="cate_name"><br>

是否显示<input type="radio" name="cate_show"value="是">是
		<input type="radio" name="cate_show"value="否">否<br>
所属分类<select name="pid">
			<option value="0">暂无分类</option>
			@foreach ($ret as $v)
			<option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
			@endforeach
		</select><br>
分类描述<textarea name="content"></textarea><br>
<input type="submit" value="提交">
</form>
