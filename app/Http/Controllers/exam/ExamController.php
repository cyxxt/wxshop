<?php

namespace App\Http\Controllers\exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Weixin;
use App\Model\U;
class ExamController extends Controller
{
    public function check()
    {
//        $appid=env('APPID');
//        $secret=env('APPSECRET');
//        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
//        $str=file_get_contents($url);
////        echo $str;
//        $arr=json_decode($str,true);
//        print_r($arr);
        $this->checkdo();
//        echo $access_token;
    }

    public function checkdo()
    {
//        echo 1;die;
//        $postStr=file_get_contents("php://input");
        $postStr = file_get_contents("php://input");
        echo $postStr;die;
        $postObj=simplexml_load_string($postStr,'SimpleXMLElement',LIBXML_NOCDATA);
//        dd($postObj);
        $fromUsername=$postObj['FromUserName'];
        $toUsername=$postObj['ToUserName'];
        $time=time();
        $texttpl="<xml>
                  <ToUserName><![CDATA[%s]]></ToUserName>
                  <FromUserName><![CDATA[%s]]></FromUserName>
                  <CreateTime>%s</CreateTime>
                  <MsgType><![CDATA[%s]]></MsgType>
                  <Content><![CDATA[%s]]></Content>
                </xml>";
//        echo 1;die;
        if($postObj['MsgType'] == 'event'){
            echo 1;
            $msgType = "text";
            $contentStr = "欢迎您关注好运平台！";
            $resultStr = sprintf($texttpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            echo $resultStr;
            $data=[
                'username'=>$fromUsername,
                'tousername'=>$toUsername,
                'time'=>$time,
            ];
            $res=U::insert($data);

        }
    }


    public function menu()
    {
        $access_token=Weixin::gettoken();
        $url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
        $str='{
     "button":[
     {
          "type":"click",
          "name":"今日歌曲",
          "key":"V1001_TODAY_MUSIC"
      },
      {
           "name":"菜单",
           "sub_button":[
           {
               "type":"view",
               "name":"搜索",
               "url":"http://www.soso.com/"
            },

            {
                    "type": "pic_sysphoto",
                    "name": "系统拍照发图",
                    "key": "rselfmenu_1_0",
                   "sub_button": [ ]
                 },

            {
                 "type":"miniprogram",
                 "name":"wxa",
                 "url":"http://mp.weixin.qq.com",
                 "appid":"wx286b93c14bbf93aa",
                 "pagepath":"pages/lunar/index"
             },
            {
               "name": "发送位置",
            "type": "location_select",
            "key": "rselfmenu_2_0"
            }]
       }]
 }';
        $srr='{
    "button": [
        {
            "name": "扫码",
            "sub_button": [
                {
                    "type": "scancode_waitmsg",
                    "name": "扫码带提示",
                    "key": "rselfmenu_0_0",
                    "sub_button": [ ]
                },
                {
                    "type": "scancode_push",
                    "name": "扫码推事件",
                    "key": "rselfmenu_0_1",
                    "sub_button": [ ]
                }
            ]
        },
        {
            "name": "发图",
            "sub_button": [
                {
                    "type": "pic_sysphoto",
                    "name": "系统拍照发图",
                    "key": "rselfmenu_1_0",
                   "sub_button": [ ]
                 },
                {
                    "type": "pic_photo_or_album",
                    "name": "拍照或者相册发图",
                    "key": "rselfmenu_1_1",
                    "sub_button": [ ]
                },
                {
                    "type": "pic_weixin",
                    "name": "微信相册发图",
                    "key": "rselfmenu_1_2",
                    "sub_button": [ ]
                }
            ]
        },
        {
            "name": "发送位置",
            "type": "location_select",
            "key": "rselfmenu_2_0"
        },
        {
           "type": "media_id",
           "name": "图片",
           "media_id": "MEDIA_ID1"
        },
        {
           "type": "view_limited",
           "name": "图文消息",
           "media_id": "MEDIA_ID2"
        }
    ]
}';
       $res=Weixin::HttpsPost($url,$str);
        if($res){
            echo 1;
        }
    }

}
