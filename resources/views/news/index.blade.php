<h1>新闻添加系统</h1>
<form action="/news/insert"method="post"enctype="multipart/form-data">@csrf
	新闻标题<input type="text"name="name">{{$errors->first('name')}}<br>
	新闻分类<select name="news_id">
			<option value="">--请选择--</option>
			@foreach ($ret as $v)
			<option value="{{$v->news_id}}">{{$v->news_name}}</option>
			@endforeach
		</select><br>
	新闻作者<input type="text"name="man">{{$errors->first('man')}}<br>
	发布时间<input type="text"name="time"><br>
			<input type="submit" value="添加">
</form>