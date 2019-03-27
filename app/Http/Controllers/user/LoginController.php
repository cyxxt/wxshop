<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Http\Controllers\Common;
use App\Http\Requests\RegisterRequest;

class LoginController extends Controller
{

    //注册页面
    public function register()
    {
        return view('register');
    }
    //只有输入手机号的注册页面
    public function registers()
    {
        return view('registers');
    }

    //上个方法跳的页面
    public function regauth(Request $request)
    {
        $tel=session('tel');
        $a=substr($tel,0,3);
        $b=substr($tel,7,11);
        $tel=$a.'****'.$b;
//        echo $b;
//        echo $tel;
        return view('regauth',['tel'=>$tel]);
    }
    //设置密码
    public function setpwd(Request $request)
    {
        return view('setpwd');
    }
//regauth点击确认跳的页面
    public function regauthdo(Request $request)
    {
        $tel=$request->tel;

        if(!empty($tel)){
            echo 1;
            session(['tel'=>$tel]);
        }else{
            die;
        }
//        echo $tel;die;

    }
    //注册执行
    public function registerdo(Request $request)
    {
//        $validate = $request->validated();
//        dd($validate->error());
//        $tel=$request->tel;
            $tel=session('tel');
//        echo $tel;die;
        $pwd=$request->pwd;
//        echo $pwd;die;
        $pwds=$request->pwds;
//        echo $pwds;
        $pwd=encrypt($pwd);
        $code=$request->code;
//        echo $code;die;
        $code1=session('mobilecode');

        $data=[
            'user_tel'=>$tel,
            'user_pwd'=>$pwd,
        ];
//        if($code==$code1){
//            echo "验证码错误";die;
//        }else{
            $res=User::insert($data);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
//        }
//        echo $pwd;


    }
//发送验证码
//    public function codedo(Request $request)
//    {
//        $tel=session('tel');
////        echo $tel;die;
//        $res=$this->sendMobile($tel);
//        if($res){
//            echo 1;
//        }else{
//            echo "发送失败";
//        }
//    }
    //登录页面
    public function login()
    {
        return view('login');
    }
    //登录执行
    public function logindo(Request $request)
    {
        $uname=$request->uname;
//        echo $uname;die;
        $pwd=$request->pwd;
//        echo $pwd;die;
        $res=User::where('user_tel',$uname)->first();
//        var_dump($res);die;
        $pwd1=decrypt($res['user_pwd']);
//        echo $pwd1;die;
        $code=$request->code;
//        echo $code;
        $code1=session('code');
        if(!empty($res)){
            if($pwd1!=$pwd){
                echo "密码错误";
            }else{

                if($code!=$code1){
                    echo "验证码错误";die;
                }else{
                    session(['user_id'=>$res['user_id']]);
                        echo 1;
                }
            }
        }else{
            echo "用户名不能为空";
        }
    }
    
    //发送验证码
//    public function sendMobile($mobile)
//    {
//        $host = env('MOBILE_HOST');
//        $path = env('MOBILE_PATH');
//        $method = "POST";
//        $appcode = env('MOBILE_APPCODE');
//        $code=1111;
//        session(['mobilecode'=>$code]);
//        $headers = array();
//        array_push($headers, "Authorization:APPCODE " . $appcode);
//        $querys = "content=【创信】你的验证码是：".$code."，3分钟内有效！&mobile=".$mobile;
//        $bodys = "";
//        $url = $host . $path . "?" . $querys;
//
//        $curl = curl_init();
//        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
//        curl_setopt($curl, CURLOPT_URL, $url);
//        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//        curl_setopt($curl, CURLOPT_FAILONERROR, false);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($curl, CURLOPT_HEADER, true);
//        if (1 == strpos("$".$host, "https://"))
//        {
//            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
//        }
//        var_dump(curl_exec($curl));
//    }
}
