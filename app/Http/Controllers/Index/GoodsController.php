<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cart;
use DB;
use Log;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\cookie;
use App\Mail\SendCode;

class GoodsController extends Controller
{
    public function index($id){
    	// dd(encrypt(123456));
    	$goods = Goods::find($id);
    	// dd($goods);
    	return view('/index/goods',['goods'=>$goods]);
    } 
     
  
    public function cartlist(){
    	 $userInfo = session('login');
      	 $user_id=$userInfo['user_id'];
      	 //dd($user_id);
    	 $ret=Cart::where('user_id',$user_id)->get();
         
         $goods_id=array_column($ret->toArray(),'goods_id');
         //dd($goods_id);
         $arr=Goods::find($goods_id);

         $count=Cart::where('user_id','=',$user_id)->count();
         //dd($arr);
    	 return view('/index/cartlist',['ret'=>$ret,'count'=>$count,'arr'=>$arr,'goods_id'=>$goods_id]);
    }

    public function pay(){
         $userInfo = session('login');
         $user_id=$userInfo['user_id'];
         //dd($user_id);
         $goods=Cart::where('user_id',$user_id)->get();
         return view('/index/pay',['goods'=>$goods]);
    }

    public function success(){
        return view('/index/success');
    }

    public function pays(){
        return view('/alipay/index');
    }
    
    public function wappaypay(){
        return view('/alipay/wappay/pay');
    }
    public function list(){
        // cookie('cartInfo',null);
        
        //获取现在的状态
        $isLogin = $this->checkLogin();
        // dump($isLogin);exit;
        if($isLogin){
            $cartList = $this->getCartListDb();
        }else{
            $cartList = $this->getCartCookie();
        }
        $this->assign('cartList',$cartList);
        // $cartInfo = cookie('cartInfo');
        // dump($cartList);exit;
        return view('list');
    }
    //添加购物车
    public function addcart(request $request){
          // 接收值
       $goods_id = $_POST['goods_id'];
       
       $buy_num = $_POST['buy_number'];
    //    echo($buy_num);exit;
       $goods_num = $_POST['goods_num'];
        // 判断接收的值是否为空
       if(empty($goods_id) || empty($buy_num)){
            $return = ['error_no'=>1,'error_msg'=>'参数缺失'];
            echo json_encode($return);exit;
       }
    //    判断用户是否在登录状态
       $isLogin = session('login');
    //    dump($isLogin);exit;
       if($isLogin){
        //    如果是登录状态，就将数据存入数据库
      $res =  $this->savecartDb($goods_id,$goods_num,$buy_num);
       }else{
        // 否则将数据存入cookie
        $res = $this->savecarCookie($goods_id,$goods_num,$buy_num);
       }
       if($res){
        return json_encode(['code'=>'00000','msg'=>'添加成功']);exit;
       }else{
        return json_encode(['code'=>'00001','msg'=>'添加失败']);exit;
       }
       // dump(cookie('cartInfo'));exit;
    //    dump($res);exit;
    }
    public function savecartDb($goods_id,$goods_num,$buy_num){
        // 接收用户IDz
        // dump($goods_num);exit;
        $user_id = $this->getUserId();
        $where = [
            ['user_id','=',$user_id],
            ['goods_id','=',$goods_id],
        ];
        // 查询购物车中是否存在此商品
        $cargoods = Cart::where($where)->first();
        if(!empty($cargoods)){ 
            //如果存在此商品就将以前购买的数量+现在购买的数量
            $cb_num = $cargoods['buy_number']+$buy_num;
            // 判断库存是否大于用户购买的 数量
            if($goods_num < $cb_num){
                $cb_num = $goods_num;
            }
                $updatecar = ['buy_number'=>$cb_num,'addtime'=>time()];
                $ret = Cart::where($where)->update($updatecar);
        }else{
                $cb_num = $buy_num;
                if($goods_num < $cb_num){
                    $cb_num = $goods_num;
                }
                $data = ['goods_id'=>$goods_id,'user_id'=>$user_id,'buy_number'=>$cb_num,'addtime'=>time()];   
                $ret = Cart::insert(['goods_id'=>$goods_id,'user_id'=>$user_id,'buy_number'=>$cb_num,'addtime'=>time()]);
            }
            return $ret;
        }

            // 游客状态
        public function savecarCookie($goods_id,$goods_num,$buy_num){
            // 取出购物车列表
            $cartInfo = empty(cookie('cartInfo')) ? [] : cookie('cartInfo');
            // 判断COOKIE中购物车类表是否为空
            if(empty($cartInfo)){
                $cb_num  = $buy_num;
                // 判断库存量是否大于等于当前购买量 
                if($goods_num < $buy_num){
                    $cb_num = $goods_num;
                }
                      // 如果为空添加COOKIE    
                $data = ['b_num'=>$cb_num,'create_time'=>time(),'goods_id'=>$goods_id];
                $cartInfo[$goods_id] = $data;
                cookie('cartInfo',$cartInfo);
                return true;
            }
            $goods_ids = array_column($cartInfo,'goods_id');
            // 判断当前goods_id是否存在于goods_ids中
            if(in_array($goods_id,$goods_ids)){
                // 原本已经存在这组数据中的购买量
                $oldb_num = $cartInfo[$goods_id]['b_num'];
                $cb_num = $oldb_num+$buy_num;

                if($goods_num > $cb_num){
                    $cb_num = $goods_num;
                }
                $cartInfo[$goods_id]['b_num'] = $cb_num;
                $cartInfo[$goods_id]['update_time'] = time();
                cookie('cartInfo',$cartInfo);
            }else{
                $cb_num = $buy_num;
                if($goods_num < $cb_num){
                    $cb_num = $goods_num;
                }
                $data = ['goods_id'=>$goods_id,'create_time'=>time(),'b_num'=>$cb_num];
                $cartInfo[$goods_id] = $data;
                cookie('cartInfo',$cartInfo);

            }
        return true;   
    }
    //获取购物车列表
    public function getCartListDb(){
        //获取当前用户的ID
        $user_id = $this->getUserId();
        //获取当前的用户的购物列表
        $Shopcart = new CartModel();
        //获取where条件
        $where = [
            ['user_id','=',$user_id],
            ['is_del','=',0]
        ];
        //获取购物车列表
        $cartList = $Shopcart::where($where)
        ->alias('c')
        ->leftJoin('shop_goods','c.goods_id = shop_goods.goods_id')
        ->order('cart_id DESC')
        ->select();
        return $cartList;
    }
    //获取购物车cookie
    public function getCartCookie(){
        //从cookie中获取购物车列表
        $cartInfo = cookie('cartInfo');
        // return $cartList;
        //判断购物车列表是否为空，如果空就返回空数组；
        if(empty($cartInfo)) return [];
        //获取列表所有的goods_id
        $create_time = array_column($cartInfo,'create_time'); 
        // dump($cartInfo);exit;
        array_multisort($create_time,SORT_DESC,$cartInfo);
        $Shopgoods=new GoodsModel();
        $cartList = [];
        foreach($cartInfo as $key=>$value){
            $where[$key]=[
                ['goods_id','=',$value['goods_id']]
            ];
            //查询商品的信息
              $goodsList[$key] = $Shopgoods::where($where[$key])->first();
              // dump(db::getLastSql());exit;
            //强制转换数组
             $goodsList[$key] = $goodsList[$key]->toArray();
            // if(empty($goodsList[$key])){
            //      $goodsList[$key]=[];
            // }else{
            //     $goodsList[$key]->toArray();
            // }
            //将商品信息和购物车合并
            $cartList[$key] = array_merge($goodsList[$key],$value);
        }
        return $cartList;
    }
    //修改购物车列表中的购买数量
    public function changeNum(){
        //接受参数
        //用获取cookie中的信息
        $goods_id = input('goods_id');
        //要修改的购买数量
        $buy_num = input('buy_num');
        //商品库存量
        $goods_num = input('goods_num');
        //非空验证
        if(empty($goods_id)||empty($buy_num)){
            echo returnJson(1,'参数缺失');exit;
        }
        //判断库存量是否大于等于购买数量
        if($goods_num < $buy_num){
            //当前购买数量 = 库存量
            $buy_num = $goods_num;
        }
        //登录状态
        $isLogin = $this->checkLogin();
        if($isLogin){
            $res = $this->changeNumdb($goods_id,$buy_num,$goods_num);
        }else{
            $res = $this->changeNumCookie($goods_id,$buy_num,$goods_num);
        }
        //返回
        if($res){
            echo returnJson(0,'修改成功');exit;
        }
            echo returnJson(1,'参数缺失');exit;
    }
    //修改数据中的购买数量
      public function changeNumdb($goods_id,$buy_num,$goods_num){
                $user_id = $this->getUserId();

                $where = [
                    ['goods_id','=',$goods_id],
                    ['user_id','=',$user_id],
                    ['is_del','=',0]
                ];
                $cModel =new cartModel();
                // 更新数据库
                $data = ['b_num'=>$buy_num,'update_time'=>time()];
                $res = $cModel::where($where)->update($data);
                // 返回结果
                return $res;
                // 获取一条数据
                $info = $cModel::where($where)->first();
            }

            // cookie
            public function changeNumCookie($goods_id,$buy_num,$goods_num){

                // 修改cookie中的值
                $cartInfo = cookie('cartInfo');
                if(empty($cartInfo)) return false;
                // 让cookie中的这组数的购买量 = 当前的购买量
                $cartInfo[$goods_num]['b_num'] = $buy_num;
                // 修改cookie中的值
                cookie('cartInfo',$cartInfo);
                return true;

            }
            //删除购物车
            public function delCart(){
                $goods_id=input('goods_id');
                $isLogin=$this->checkLogin();
                if($isLogin){
                    $res=$this->delCartDb($goods_id);
                }else{
                    $res=$this->delCartCookie($goods_id);
                }
                if($res){
                    echo echoJson(0,'删除成功');
                    exit;
                }else{
                    echo echoJson(1,'删除失败');
                    exit;
                }
            }
            public function delCartDb($goods_id){
                $CartModel=new CartModel();
                $user_id=$this->getUserId();
                $where=[
                    ['user_id','=',$user_id],
                    ['goods_id','IN',$goods_id],
                    ['is_del','=',0]
                ];
                $res=$CartModel::where($where)->update(['is_del'=>1]);
                return $res;    
            }
            public function delCartCookie($goods_id){
                $cartInfo=cookie('cartInfo');
                if(empty($cartInfo)) return true;
                if(substr_count($goods_id,',') > 0){
                    $goods_id=explode(',',$goods_id);
                    foreach($goods_id as $key=>$value){
                        if(in_array($cartInfo[$value],$cartInfo)){
                            unset($cartInfo[$value]);
                        }
                    }
                }else{
                    unset($cartInfo[$goods_id]);
                }
                cookie('cartInfo',$cartInfo);
                return true;
            }
            public function getUserId(){
      			  $userInfo = session('login');
      			  return $userInfo['user_id'];
  			  }
 public function notify_url(){

    Log::info('测试支付宝支付');
    $config = config('alipay');
    require_once app_path('libs/alipay/wappay/service/AlipayTradeService.php');


$arr=$_POST;
$alipaySevice = new \AlipayTradeService($config); 
$alipaySevice->writeLog(var_export($_POST,true));
$result = $alipaySevice->check($arr);

/* 实际验证过程建议商户添加以下校验。
1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
4、验证app_id是否为该商户本身。
*/
if($result) {//验证成功
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //请在这里加上商户的业务逻辑程序代

    
    //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
    
    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
    
    //商户订单号

    $out_trade_no = $_POST['out_trade_no'];

    //支付宝交易号

    $trade_no = $_POST['trade_no'];

    //交易状态
    $trade_status = $_POST['trade_status'];


    if($_POST['trade_status'] == 'TRADE_FINISHED') {

        //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
            //如果有做过处理，不执行商户的业务程序
                
        //注意：
        //退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
    }
    else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
        //判断该笔订单是否在商户网站中已经做过处理
            //如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
            //请务必判断请求时的total_amount与通知时获取的total_fee为一致的
            //如果有做过处理，不执行商户的业务程序            
        //注意：
        //付款完成后，支付宝系统发送该交易状态通知
    }
    //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
        
    echo "success";     //请不要修改或删除
        
}else {
    //验证失败
    echo "fail";    //请不要修改或删除

}
}

}
