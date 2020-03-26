<h1>文章添加系统</h1>
<form action="/article/insert"method="get"enctype="multipart/form-data">@csrf
	文章标题<input type="text"name="name">{{$errors->first('name')}}<br>
	文章分类<select name="c_id">
				<option value="">--请选择--</option>
				<option value="议论">议论</option>
				<option value="说明">说明</option>
			</select>{{$errors->first('c_id')}}<br>
	文章重要性<input type="radio"name="radio"value="普通">普通
				<input type="radio"name="radio"value="置顶">置顶{{$errors->first('radio')}}<br>
	文章重要性<input type="radio"name="show"value="显示">显示
				<input type="radio"name="show"value="不显示">不显示{{$errors->first('show')}}<br>
	文章作者<input type="text"name="man"><br>
	作者email<input type="e-mail" name="email"><br>
	关键字<input type="text"name="keyword"><br>
	网页描述<textarea name="detail"></textarea><br>
	上传文件<input type="file" name="img"><br>
			<input type="submit" value="添加">
</form>