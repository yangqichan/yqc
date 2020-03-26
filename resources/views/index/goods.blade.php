     @extends('layouts.shop')
     @section('title','详情')
     @section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
 <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      @if($goods->goods_imgs)
      @php $goods_imgs = explode('|',$goods->goods_imgs);@endphp
      @foreach($goods_imgs as $v)

      <img src="{{env('UPLOADS_URL')}}{{$v}}" id="div_2" />
      @endforeach
      @endif
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$goods->goods_price}}</strong></th>
       <td>
        <input type="button" value="-" class="car_btn_1" id="minus" />
        <input type="text" class="spinnerExample" goods_num="{{$goods->goods_number}}" goods_id="{{$goods->goods_id}}"value="0"id="div_1"/>
        <input type="button" value="+" class="car_btn_2" id="add" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$goods->goods_name}}</strong>
        <p class="hui">富含纤维素，平衡每日膳食</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      {{$goods->goods_desc}}
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a id="addcart" href="javascript:void(0)">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
        @include('index.public.footer');

        <script type="text/javascript">
          $(document).on('click', '#add', function () {
            var _this = $(this);
            // 获取库存量
            var goods_num = parseInt(_this.parents("tr").attr('goods_num'));
            var buy_num = parseInt(_this.prev().val());
            // console.log(goods_num);
            // console.log(buy_num);
            // 判断当前的库存量不能小与购买数量
            if (goods_num < (buy_num + 1)) {
                alert('存库不足');
                return false;
            } else {
                buy_num = buy_num + 1;
                _this.prev().val(buy_num);
            }
        });
          $(document).on("click","#minus",function(){
            var _this=$(this);
            var buy_num=parseInt(_this.next().val());
            var goods_num=parseInt(_this.parents("tr").attr("goods_num"));
            if(buy_num <= 1){
                _this.next().val(1);
                alert('宝贝不能再少了');
                return false;
            }else{
                buy_num=buy_num-1;
                _this.next().val(buy_num);
            }
        });
          $("#addcart").click(function(){
            var goods_id=$("#div_1").attr('goods_id');
            var buy_number = $('.spinnerExample').val();
            var goods_num=$("#div_1").attr('goods_num');
            var img=$("#div_2").val();
            if(buy_number<1){
              alert('请更改数量');
              return;
            }
            $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
            $.post('/log/addcart',{goods_id:goods_id,buy_number:buy_number,goods_num:goods_num,},function(result){
              if(result.code='00000'){
                alert(result.msg);
                return;
              }else{
                alert(result.msg);
                location.href=location.href;
              }
            },'json')
          });

        </script>
     @endsection