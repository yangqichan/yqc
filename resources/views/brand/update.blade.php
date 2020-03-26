<form action="{{url('/brand/updates'.$ret->id)}}"method="post"enctype="multipart/form-data">@csrf
	学生姓名<input type="text"name="name"value="{{$ret->name}}"><br>
	学生性别<input type="radio" name="sex" 
	value="男"{{$ret->sex=='男' ? "checked" : ""}}>男<input type="radio" name="sex" value="女"value="女"{{$ret->sex=='女' ? "checked" : ""}}>女<br>
	学生照片<input type="file" name="img">@if($ret->img)<img src="{{env('UPLOADS_URL')}}{{$ret->img}}"width="50"height="35">@endif<br>
	学生班级<select name="varchar">
				<option value="1907A" {{$ret->varchar=='1907A' ? "selected" : ""}}>1907A</option>
				<option value="1907B" {{$ret->varchar=='1907B' ? "selected" : ""}}>1907B</option>
			</select><br>
			<input type="submit" value="修改">
</form>