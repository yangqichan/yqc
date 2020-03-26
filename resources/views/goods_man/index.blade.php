<h1>管理员添加系统</h1>
<form action="/goods_man/insert"method="post"enctype="multipart/form-data">@csrf
	管理员名称<input type="text"name="name">{{$errors->first('name')}}<br>
	管理员密码<input type="password"name="psd">{{$errors->first('psd')}}<br>
	管理员邮箱<input type="e-mail"name="email">{{$errors->first('email')}}<br>
	管理员电话<input type="tel"name="tel">{{$errors->first('tel')}}<br>
	管理员照片<input type="file" name="img"><br>
			<input type="submit" value="添加">
</form>