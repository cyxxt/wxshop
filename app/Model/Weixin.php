<?php
namespace App\Model;
use Illuminate\Support\Facades\Storage;
class Weixin
{
    /**
     * @param $url
     * @param $post_datas
     * @return mixed
     * @content 模拟post
     */
    public static function HttpsPost($url,$post_datas)
    {

        //1、初始化
        $curl = curl_init();
        //2、设置选项，包括URL
        curl_setopt($curl, CURLOPT_URL, $url);
        //将curl_exec()获取的信息以文件流的形式返回，而不是直接输出
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //启动时会将头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置为post
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        //把post的变量加上
        curl_setopt($curl, CURLOPT_POSTFIELDS,$post_datas);
        //3、执行并获取HTML文档内容
        $data=curl_exec($curl);
        //4、释放句柄
        curl_close($curl);
        return $data;
    }

    /**
     * @param $keyword
     * @return string
     */
    public static function getcity($keyword)
    {
        $city=substr($keyword,0,strpos($keyword,'天气'));

        return $city;
    }

    /**
     * @param $city
     * @return string
     */
    public static function getcitywether($city)
    {
        $url="http://api.k780.com/?app=weather.today&weaid=$city&appkey=41468&sign=8766eac902a478645296bd4e90db7eff&format=json";
        $data=file_get_contents($url);
        $data=json_decode($data,true);
        $result=$data['result'];
        $str="今天是".$result['days'].'日'.$result['week']."\r\n";
        $str.='天气'.$result['weather']."\r\n";
        $str.="您所在的城市".$result['citynm']."\r\n";
        $str.='今日气温最高'.$result['temp_high'].'最低'.$result['temp_low'];
        return $str;
    }

    /**
     * @return mixed
     */
    public static function gettoken()
    {
        $path=public_path().'/wx/'.'weixin.txt';
        $str=file_get_contents($path);
        if(!empty($str)){
            $time=time();
            $data=json_decode($str,true);
            if($data['expire']<$time){
                $token=self::setaccesstoken();
                $expire=time()+7000;
                $data=[
                    'token'=>$token,
                    'expire'=>$expire
                ];
                $str=json_encode($data);
                file_put_contents($path,$data);
            }else{
                $token=$data['token'];
            }

        }else{
            $token=self::setaccesstoken();
            $expire=time()+7000;
            $data=[
                'token'=>$token,
                'expire'=>$expire
            ];
            $str=json_encode($data);
            file_put_contents($path,$data);
        }
        return $token;
    }
    /**
     * @content 生成access_token
     * 
     */
    public static function setaccesstoken()
    {
        $appid=env('APPID');
        $secret=env('APPSECRET');
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
        $str=file_get_contents($url);
//        return $str;
        $data=json_decode($str,true)['access_token'];
        return $data;
    }

    /**
     * @param $str
     * @return mixed
     */
    public static function gettype($str)
    {
        $str=explode('/',$str);
//        return $str;
        $type=$str[0];
        $arr=[
            'image'=>'image',
            'audio'=>'audio',
            'video'=>'video'
        ];
        $typee=$arr[$type];
        return $typee;
    }

    /**
     * @param $file
     * @return array
     */
    public static function up($file)
    {
        //接收文件类型
        $data=$file->getClientMimeType();
        //获取文件的后缀名
        $ext=$file->getClientOriginalExtension();
//        echo $ext;
        //获取当前文件的位置 临时文件
        $path=$file->getRealPath();
//        echo $path;
        //上传后的文件名称
        $newfilename=date('Ymd')."/".mt_rand(100,999).'.'.$ext;

        //上传文件
        $res=Storage::disk('uploads')->put($newfilename,file_get_contents($path));
        $imgpath=public_path().'/uploads/'.$newfilename;
        $data=['data'=>$data,'imgpath'=>$imgpath];
        return $data;
    }
    //
    public static function news($fromUsername,$toUsername,$time,$type)
    {
        $arr=News::where('type',$type)->orderBy('id','desc')->first();
        $resurl="<xml>
              <ToUserName><![CDATA[%s]]></ToUserName>
              <FromUserName><![CDATA[%s]]></FromUserName>
              <CreateTime><![CDATA[%s]]></CreateTime>
              <MsgType><![CDATA[%s]]></MsgType>
              <ArticleCount>1</ArticleCount>
              <Articles>
                <item>
                  <Title><![CDATA[%s]]></Title>
                  <Description><![CDATA[%s]]></Description>
                  <PicUrl><![CDATA[%s]]></PicUrl>
                  <Url><![CDATA[%s]]></Url>
                </item>
              </Articles>
        </xml>";
        $msgtype="news";
        $title=$arr['title'];
        $des=$arr['content'];
        $picurl=$arr['img'];
        $url=$arr['url'];
        $result=sprintf($resurl,$fromUsername,$toUsername,$time,$msgtype,$title,$des,$picurl,$url);
        echo $result;

    }
   

}

