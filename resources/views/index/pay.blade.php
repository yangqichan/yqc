<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="/static/index/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="/static/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/index/css/style.css" rel="stylesheet">
    <link href="/static/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond./static/index/js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <div class="dingdanlist" onClick="">
      <table>
       <tr>
        <td class="dingimg" width="75%" colspan="2">新增收货地址</td>
        <td align="right"><img src="/static/index/images/jian-new.png" /></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">选择收货时间</td>
        <td align="right"><img src="/static/index/images/jian-new.png" /></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">支付方式</td>
        <td align="right"><span class="hui">网上支付</span></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">优惠券</td>
        <td align="right"><span class="hui">无</span></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#efefef;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">是否需要开发票</td>
        <td align="right"><a href="javascript:;" class="orange">是</a> &nbsp; <a href="javascript:;">否</a></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">发票抬头</td>
        <td align="right"><span class="hui">个人</span></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">发票内容</td>
        <td align="right"><a href="javascript:;" class="hui">请选择发票内容</a></td>
       </tr>
       <tr><td colspan="3" style="height:10px; background:#fff;padding:0;"></td></tr>
       <tr>
        <td class="dingimg" width="75%" colspan="3">商品清单</td>
       </tr>
       @foreach($goods as $v)
       <tr>
        <td width="4%"><input type="checkbox" checked="true" id="div_4" price="{{$v->goods_price}}" num="{{$v->buy_number}}" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date("Y-m-d H:i",$v->create_time)}}</time>
        </td>
        <td align="right"><span class="qingdan">X {{$v->buy_number}}</span></td>
       </tr>
       <tr>
        <th colspan="3"><strong class="orange"id="div_1" >¥{{$v->goods_price}}</strong></th>
       </tr>
      @endforeach
       
       <tr>
        <td class="dingimg" width="75%" colspan="2">商品金额</td>
        <td align="right"><strong class="orange"></strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">折扣优惠</td>
        <td align="right"><strong class="green">¥0.00</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">抵扣金额</td>
        <td align="right"><strong class="green">¥0.00</strong></td>
       </tr>
       <tr>
        <td class="dingimg" width="75%" colspan="2">运费</td>
        <td align="right"><strong class="orange" id="div_2">¥20.80</strong></td>
       </tr>
      </table>
     </div><!--dingdanlist/-->
     
     
    </div><!--content/-->
    
    <div class="height1"></div>
    <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="div_3">¥</strong></td>
       
       <td width="40%"><a href="{{url('/log/success')}}" class="jiesuan">提交订单</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>
    <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
</html>

<script type="text/javascript">
    
    $(document).ready(function(){
          var money=0;
          var div_2=$("#div_2").text();
          $("#div_4:checked").each(function(){
                var _this = $(this);
                var price=_this.attr('price');
                var num=_this.attr('num');
                  //每一组数的小计
              xj=price*num;
                  //每一组小计相加
              money += Number(xj);
              });
            //清空总价
          money +=20.80;
          $("#div_3").text('');
            //讲总价放入
          $("#div_3").text('￥' + money);
        });
    $(document).on("click", '#div_4', function () {
            var _this = $(this);
            //判断当前复选框是否选中状态
            var isCheck = _this.prop('checked');
            //如果被选中,添加样式类,否则删除样式类
            state = isCheck == true ? 0 : 1;
            //获取总价
            getTotalMoney();
        });
        //获取总价
        function getTotalMoney() {
            //循环checkbox , 只有被选中，才会被记入总价
            //查看是否有被选中的复选框
            var box = $("#div_4:checked");
            //如果没有被选中的复选框，则表明总价为0
            if (box.length == 0) {
                $("#div_3").text('￥' + 0);
                return false;
            }
            var money = 0;
            //循环我的被选中的checked
            $("#div_4:checked").each(function () {
                var _this = $(this);
                var price=_this.attr('price');
                var num=_this.attr('num');
                //每一组数的小计
                xj=price*num;
                //每一组小计相加
                money += Number(xj);
            });
            money +=20.80;
            //清空总价
            $("#div_3").text('');
            //讲总价放入
            $("#div_3").text('￥' + money);
        };


</script>