<h1>后台登录页面</h1>
{{session('msg')}}
<form action="{{url('/logindo')}}" method="post" enctype="multipart/form-data">
@csrf
账号<input type="text" name="admin_name"><br>
密码<input type="password"name="admin_psd"><br>
<input type="submit" value="登录">
</form>