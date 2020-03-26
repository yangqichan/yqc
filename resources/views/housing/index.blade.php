<form action="{{url('/housing/insert')}}" method="post" enctype="multipart/form-data">
<h1>小区添加管理</h1>@csrf
小区名称<input type="text" name="name"><br>
导购人<input type="text"name="man"><br>
导购人电话<input type="tel" name="tel"><br>
房屋面积<input type="text" name="mj"><br>
房屋图片<input type="file" name="img"><br>
房屋相册<input type="file" name="imgs[]"multiple="multiple"><br>
售价<input type="text" name="price"><br>
<input type="submit" value="添加">
</form>