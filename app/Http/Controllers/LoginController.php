<?php

namespace App\Http\Controllers;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use Illuminate\Http\Request;
use App\Admin;
class LoginController extends Controller
{
    public function login(){
    	return view('login');
    }
    public function logindo(Request $request){
    	$post=request()->except('_token');
    	$post['admin_psd']=md5(md5($post['admin_psd']));
    	$adminuser=Admin::where($post)->first();
   		if($adminuser){
   			session(['adminuser'=>$adminuser]);
   			return redirect('/news/index');
   		} 	
   		return redirect('/login')->with('msg','用户名或密码错误');
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
