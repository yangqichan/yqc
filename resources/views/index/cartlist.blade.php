@extends('layouts.shop') 
@section('title','购物车列表')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     
     <div class="dingdanlist">

      <table>
       <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 全选</a></td>
       </tr>
        @foreach($ret as $v)
       <tr>
        <td width="4%"><input type="checkbox" name="1"id="div_1" price="{{$v->goods_price}}" num="{{$v->buy_number}}" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间：{{date("Y-m-d H:i:s",$v->addtime)}}</time>
        </td>
        <td align="right">
          <input type="text" class="spinnerExample" id="div_2"value="{{$v->buy_number}}"/></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange" >¥{{$v->goods_price}}</strong></th>
       </tr>
       @endforeach
      </table>
     </div><!--dingdanlist/-->
     <div class="height1"></div>
     <div class="gwcpiao">

     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange" id="div_3">¥</strong></td>
       <td width="40%"><a href="{{url('/log/pay')}}" class="jiesuan">去结算</a></td>
      </tr>
     </table>

    </div><!--gwcpiao/-->
<!-- @include('index.public.footer'); -->

<script type="text/javascript">
    
    $(document).on("click", '#div_1', function () {
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
            var box = $("#div_1:checked");
            //如果没有被选中的复选框，则表明总价为0
            if (box.length == 0) {
                $("#div_3").text('￥' + 0);
                return false;
            }
            var money = 0;
            //循环我的被选中的checked
            $("#div_1:checked").each(function () {
                var _this = $(this);
                var price=_this.attr('price');
                var num=_this.attr('num');
                //每一组数的小计
                xj=price*num;
                //每一组小计相加
                money += Number(xj);
            });
            //清空总价
            $("#div_3").text('');
            //讲总价放入
            $("#div_3").text('￥' + money);
        };










</script>
      @endsection