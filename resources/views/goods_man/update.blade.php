<h1>管理员修改系统</h1>
<form action="{{url('/goods_man/update'.$ret->id)}}"method="post"enctype="multipart/form-data">@csrf
	管理员名称<input type="text"name="name" value="{{$ret->name}}">{{$errors->first('name')}}<br>
	管理员密码<input type="password"name="psd"value="{{$ret->psd}}">{{$errors->first('psd')}}<br>
	管理员邮箱<input type="e-mail"name="email"value="{{$ret->email}}">{{$errors->first('email')}}<br>
	管理员电话<input type="tel"name="tel"value="{{$ret->tel}}">{{$errors->first('tel')}}<br>
	管理员照片<input type="file" name="img">@if($ret->img)<img src="{{env('UPLOADS_URL')}}{{$ret->img}}"width="50"height="35">@endif<br>
			<input type="submit" value="修改">
</form>