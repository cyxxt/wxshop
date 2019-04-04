<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Support\Facades\Redis;

class RegisterController extends Controller
{
    //
    public function register()
    {
        return view('user.register');
    }


    public function registerdo(Request $request)
    {
        $user_name=$request->user_name;
        $user_pwd=$request->user_pwd;
        $user_pwd=encrypt($user_pwd);
        $code=$request->code;
//        $code1=session('mobilecode');
        $times=session('time');
        $time=time();
        if($time-$times<120){
            $code1=2222;
        }else{
            echo "您的验证码已过期";die;
        }

        $data=[
            'user_tel'=>$user_name,
            'user_pwd'=>$user_pwd,
            'user_code'=>$code
        ];
        if($code==$code1){
            $data['user_code']=$code1;
        }else{
            echo 3;die;
        }
//        print_r($data);die;
        $res=User::insert($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    public function login()
    {
        return view('user.login');
    }

    public function logindo(Request $request)
    {
        $user_name=$request->user_name;
//        Redis::flushAll();die;
        $user_pwd=$request->user_pwd;
        $where=[
            'user_tel'=>$user_name
        ];
        $arr=User::where($where)->first();
        $user_id=$arr['user_id'];
//        print_r($arr);die;
//        echo $arr['user_pwd'];die;
        $pwd1=decrypt($arr['user_pwd']);
//        echo $pwd1;die;
        $user_name=$arr['user_tel'];
//        echo $user_name;die;
        $time=time();
        $last_error_time=$arr['last_error_time'];
        $error_num=$arr['error_num'];
        $where=[
            'user_id'=>$arr['user_id']
        ];
        if(!empty($arr)){
            if($user_pwd==$pwd1){
                if($time-$last_error_time<3&&$error_num>=5){
                    $m=60-ceil( ($time-$last_error_time)/60);
                    echo "您还有".$m.'分钟才能解锁';die;
                }else{
                    $data=[
                        'error_num'=>0,
                        'last_error_time'=>null
                    ];
                    User::where($where)->update($data);
                    session(['user_id'=>$user_id]);

                    Redis::set('tel',$user_name);


                    echo 3;
                }

            }else{
                if($time-$last_error_time>3600){
                    $data=[
                        'error_num'=>1,
                        'last_error_time'=>time()
                    ];
                    User::where($where)->update($data);
                    echo '您的密码或账号有误';die;
                }else{
                    if($error_num>=5){
                        echo "您的账号已锁定";die;
                    }else{
                        $num=$error_num+1;
                        $data=[
                            'error_num'=>$num,
                            'last_error_time'=>$time
                        ];
                        User::where($where)->update($data);
                        $num=5-($error_num+1);
                        echo "您的账号或密码有误，您还有".$num.'次机会';die;
                    }
                }
                echo '密码错误';die;
            }
        }else{
            echo 1;die;
        }
    }

    public function lists()
    {
        $tel=Redis::get('tel');
        $user_id=session('user_id');
//        echo $user_id;die;
        $where=[
            'user_id'=>$user_id
        ];
        $arr=User::where($where)->get();
        return view('user.list',['arr'=>$arr,'tel'=>$tel]);
    }

    public function codedo(Request $request)
    {
        $user_tel=$request->user_name;
        $this->sendMobile($user_tel);
    }

//发送验证码
    public function sendMobile($mobile)
    {
        $time=time();
        $host = env('MOBILE_HOST');
        $path = env('MOBILE_PATH');
        $method = "POST";
        $appcode = env('MOBILE_APPCODE');
        $code=rand(1000,9999);
        session(['mobilecode'=>$code,'time'=>$time]);
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "content=【创信】你的验证码是：".$code."，3分钟内有效！&mobile=".$mobile;
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        var_dump(curl_exec($curl));
    }

}
