<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Login as LoginModel;
use App\Http\Requests\StoreBrandPost;
use Validator;
use DB;
//邮箱
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
use App\Shop_goods;

use App\Goods;
use App\User;
use Illuminate\Support\Facades\Cookie;
use App\Member;
class LoginController extends Controller
{


    public function log(){
    	return view('index.login');
    }


     public function reg(){
    	return view('index.reg');
    }


    public function sendSMS(){
    	$name =  request()->name;
    	//php验证手机号
    	$reg = '/^1[3|4|5|6|7|8|9]\d{9}$/';
    	if(!preg_match($reg, $name)){
    		return json_encode(['code'=>'00001','msg'=>'请输入正确的手机号']);
    	}
    	$code = rand(1000000,9999999);
    	$result = $this->send($name,$code);
    	//发送成功
    	if($result['Message']=='OK'){
    		session(['code'=>$code]);
    		return json_encode(['code'=>'00000','msg'=>'发送成功']);
    	}
    	//发送失败
    		return json_encode(['code'=>'00000','msg'=>$result['Message']]);

    }


      public function insert(Request $request){
        $name=$_POST['name'];
        $password=$_POST['password'];
        $ret=LoginModel::insert([['name'=>$name],['password'=>$password]]);
        if($ret){
          return redirect('/logs');
        }
      }


      public function index(){
        $res=session('login');
        $img=Goods::all();
        return view('index.index',['res'=>$res,'img'=>$img]);
      }


      public function login(){
          $name=$_GET['name'];
          $password=$_GET['password'];
          $res=LoginModel::where([['name','=',$name],['password','=',$password]])->first();
          if($res){
            session(['login'=>$res]);
            return redirect('/log/index');
          }else{
            return redirect('/logs');
          }
      }


      public function detail($id){
        $img=Shop_goods::where([['goods_id','=',$id]])->get();
        if($img){
          return view('index.detail',['img'=>$img]);
        }
      }



         //注册
    public function doRegister()
    {
      $post = request()->except(['_token','user_qpwd']);

        $codes =  session('code');
        if(!($post['code']==$codes)){
            return redirect('/reg')->with('msg','验证码错误');
        }
        $posts = request()->except(['_token','user_qpwd','code']);
        $posts['user_pwd'] = encrypt($posts['user_pwd']);

        $user = new User();
        $ret = $user::insert($posts);
        session('code',null);
        if($ret){
            return redirect('/log');
        }
        return redirect('/reg')->with('msg','注册失败');

    }


      public function addcookie(){
      Cookie::query(Cookie::make('num','lisi',1));
    }

    public function getcookie(){
     echo request()->cookie('age');

    }

    public function dologin(){
      $post = request()->all();
      // dd($post);
        $user = Member::where('useraname',$post['useraname'])->first();
        if(decrypt($user->pwd)!=$post['pwd']){
          return redirect('/log')->with('msg','用户名密码错误');
        }
        session(['user'=>$user]);
        if($post['fefer']){
          return redirect($post['fefer']);
        }
        return redirect('/');
    }
      public function sendEmail(){
        $name =  request()->name;
        //php验证邮箱
        $reg = '/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/';
      if(!preg_match($reg, $name)){
        return json_encode(['code'=>'00001','msg'=>'请输入正确的手机号或邮箱']);
      }
      $code=rand(100000,999999);
      Mail::to($name)->send(new SendCode($code));
        session(['code'=>$code]);
        return json_encode(['code'=>'00000','msg'=>'发送成功']);
      }
     public function send($name,$code){


// Download：https://github.com/aliyun/openapi-sdk-php
// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

AlibabaCloud::accessKeyClient('LTAI4Fi8GPVF2AdNjySnLbpG', 'GWFC7NYppkS0CWSgfhDHbGMPitBQwQ')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();

try {
    $result = AlibabaCloud::rpc()
                          ->product('Dysmsapi')
                          // ->scheme('https') // https | http
                          ->version('2017-05-25')
                          ->action('SendSms')
                          ->method('POST')
                          ->host('dysmsapi.aliyuncs.com')
                          ->options([
                                        'query' => [
                                          'RegionId' => "cn-hangzhou",
                                          'PhoneNumbers' => $name,
                                          'SignName' => "蛋蛋小院",
                                          'TemplateCode' => "SMS_182670340",
                                          'TemplateParam' => "{code:$code}",
                                        ],
                                    ])
                          ->request();
    return($result->toArray());
} catch (ClientException $e) {
    return $e->getErrorMessage() . PHP_EOL;
} catch (ServerException $e) {
    return $e->getErrorMessage() . PHP_EOL;
}
    }

}