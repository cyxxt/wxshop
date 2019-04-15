<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Weixin;
use Illuminate\Support\Facades\Storage;
use Memcache;

class MaterialController extends Controller
{
    public function updo(Request $request)
    {
        $file=$request->file;
        //获取文件的类型
        $data=$file->getClientMimeType();
//        dd($type);die;
        //获取文件的后缀名
        $ext=$file->getClientOriginalExtension();
        //获取当前文件的位置
        $path=$file->getRealPath();
        //新名字
        $newfilename=date("Ymd").'/'.mt_rand(1111,9999).'.'.$ext;
//        dd($newfilename);
        $res=Storage::disk('uploads')->put($newfilename,file_get_contents($path));
        if($res){
            $token=Weixin::gettoken();
            $type=Weixin::gettype($data);
            $url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$token&type=$type";
//            echo $url;
            $path=public_path().'/uploads/'.$newfilename;
            $arr=[
                'media'=>new \CURLFile(realpath($path))
            ];
            $re=Weixin::HttpsPost($url,$arr);
            $data=json_decode($re,true)['media_id'];
//            echo $data;
           
//            print_r($data);
        }
    }

    public function material()
    {
//        echo 1;die;

        return view('ma.material');
    }
}
