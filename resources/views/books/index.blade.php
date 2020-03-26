<h1>图书添加系统</h1>
<form action="/books/insert"method="post"enctype="multipart/form-data">@csrf
	图书名称<input type="text"name="name">{{$errors->first('name')}}<br>
	图书作者<input type="text"name="man">{{$errors->first('man')}}<br>
	图书价格<input type="text"name="price"><br>
	图书照片<input type="file" name="img"><br>
			<input type="submit" value="添加">
</form>