<?php

namespace App\Http\Controllers\Wechat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Weixin;
use App\Model\News;
use App\Model\Goods;


class WechatController extends Controller
{
    /**
     * @content 微信绑定服务器校验
     * @param Request $request
     */
    public function check(Request $request)
    {
        //执行推送消息的方法
        $this->checkdd();
    }


    public function checkdd()
    {
        $postStr=file_get_contents("php://input");
//        echo $postStr;die;
        $postObj=simplexml_load_string($postStr,'SimpleXMLElement',LIBXML_NOCDATA);
        $fromUsername=$postObj->FromUserName;
        $toUsername=$postObj->ToUserName;
        $time=time();
        $keyword=$postObj->Content;
        $texttpl="<xml>
                  <ToUserName><![CDATA[%s]]></ToUserName>
                  <FromUserName><![CDATA[%s]]></FromUserName>
                  <CreateTime>%s</CreateTime>
                  <MsgType><![CDATA[%s]]></MsgType>
                  <Content><![CDATA[%s]]></Content>
                </xml>";
        if($postObj->MsgType == 'event'){
            $type=config('type.subscribe');
            Weixin::$type($fromUsername,$toUsername,$time,$type);
        }

        if($keyword=='图片'){
            $texttpl="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime><![CDATA[%s]]></CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <Image>
                            <MediaId><![CDATA[%s]]></MediaId>
                          </Image>
                        </xml>";
            $msgtype='image';
            $media_id="hW8vYRnn3MPGacIVXn118hEWAahA9KaRc4EMju4-R_6YHnL9wlNRUSgYdjtjW2oV";
            $result=sprintf($texttpl,$fromUsername,$toUsername,$time,$msgtype,$media_id);
            echo $result;
        }
        if($keyword=='图文'){
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
            $title="图文饿肚肚多";
            $des="我的第一个图文";
            $picurl=url('/uploads/20190408/800.gif');
            $url="http://blog.aulei521.com";
            $result=sprintf($resurl,$fromUsername,$toUsername,$time,$msgtype,$title,$des,$picurl,$url);
            echo $result;

        }
        $arrr=Goods::where('goods_name',$keyword)->first();
        if(!empty($arrr)){
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
            $title=$keyword;
            $des=$arrr['goods_desc'];
            $picurl=url('/goodsimg/'.$arrr['goods_img']);
            $url="http://blog.aulei521.com";
            $result=sprintf($resurl,$fromUsername,$toUsername,$time,$msgtype,$title,$des,$picurl,$url);
            echo $result;
        }
        if(strstr($keyword,'订单')){
            $order=Weixin::getordernum($keyword);
            $msgtype='text';
            $content=$order;
            $result=sprintf($texttpl,$fromUsername,$toUsername,$time,$msgtype,$content);
            echo $result;die;
        }
//        $data=Goods::select(['goods_na me'])->get();
//        $goods_name='';
//        foreach($data as $v){
//            $goods_name.=$v['goods_name'].',';
//        }
//        $data=explode(',',$goods_name);
//        if(in_array($keyword,$data)){
//            $resurl="<xml>
//              <ToUserName><![CDATA[%s]]></ToUserName>
//              <FromUserName><![CDATA[%s]]></FromUserName>
//              <CreateTime><![CDATA[%s]]></CreateTime>
//              <MsgType><![CDATA[%s]]></MsgType>
//              <ArticleCount>1</ArticleCount>
//              <Articles>
//                <item>
//                  <Title><![CDATA[%s]]></Title>
//                  <Description><![CDATA[%s]]></Description>
//                  <PicUrl><![CDATA[%s]]></PicUrl>
//                  <Url><![CDATA[%s]]></Url>
//                </item>
//              </Articles>
//        </xml>";
//            $msgtype="news";
//            $title=$keyword;
//            $des=$arrr['goods_desc'];
//            $picurl=url('/goodsimg/'.$arrr['goods_img']);
//            $url="http://blog.aulei521.com";
//            $result=sprintf($resurl,$fromUsername,$toUsername,$time,$msgtype,$title,$des,$picurl,$url);
//            echo $result;
//        }
        if($keyword=='你'){
            $msgtype='text';
            $content='我是小猪佩奇';
            $result=sprintf($texttpl,$fromUsername,$toUsername,$time,$msgtype,$content);
            echo $result;die;
        }else if(strpos($keyword,'天气')){
            $msgtype='text';
            $city=Weixin::getcity($keyword);
            $url=Weixin::getcitywether($city);
            $content=$url;
            $result=sprintf($texttpl,$fromUsername,$toUsername,$time,$msgtype,$content);
            echo $result;die;
        } else{

            $data = [
                'perception' => [
                    'inputText' => [
                        'text' =>$keyword
                    ],
                ],
                'userInfo' => [
                    'apiKey' => 'c067dd0b957d4b68a2040463be23ae3d',
                    'userId' => "dong123412bao"
                ]
            ];
            $post_data=json_encode($data);
            $url="http://openapi.tuling123.com/openapi/api/v2";
            $re= Weixin::HttpsPost($url,$post_data);
            $msg=json_decode($re,true)['results'][0]['values']['text'];
            $msgtype='text';
            $content=$msg;
            file_put_contents('/tmp/111.log',$content,FILE_APPEND);
            $result=sprintf($texttpl,$fromUsername,$toUsername,$time,$msgtype,$content);
            echo $result;die;
        }

    }
    /**
     * @content 校验微信签名
     * @return bool
     */
    public function responseMsg($signature,$timestamp,$nonce)
    {

            $token    =env('WEIXINTOKEN');
            $arr=array($token,$timestamp,$nonce);
            sort($arr);
            $arrStr=implode($arr);
            $sign=sha1($arrStr);
            if($sign==$signature){
                return true;
            }else{
                return false;
        }
    }
}
