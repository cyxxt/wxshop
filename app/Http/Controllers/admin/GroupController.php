<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Weixin;
class GroupController extends Controller
{
    //获取用户列表
    public function setUser()
    {
        $token=Weixin::gettoken();
//        echo $token;die;
        $user_url='https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='.$token;
//        echo $user_url;
        $userInfo=Weixin::setAllUser();
//        print_r($userInfo);

//        $user_array=[
//            'touser'=>$userInfo,
//            "msgtype"=> "text",
//            "text"=>[
//                'content'=>"清早起床 提着花篮轻轻唱",
//            ]
//        ];
        $token=Weixin::tupian();
        echo $token;die;
        $user_array='{
   "articles": [     {
                        "thumb_media_id":"qI6_Ze_6PtV7svjolgs-rN6stStuHIjs9_DidOHaj0Q-mwvBelOXCFZiq2OsIU-p",
                        "title":"Happy Day",
                        "content":"content",
                        },
   ]
}';
//        print_r($user_array);
        $str=json_encode($user_array,JSON_UNESCAPED_UNICODE);
        $res=Weixin::HttpsPost($user_url,$str);
        print_r($res);
    }

    public function label()
    {
        $token=Weixin::gettoken();
        $url="https://api.weixin.qq.com/cgi-bin/tags/create?access_token=$token";
        $data=[
            'tag'=>[
                'name'=>'qq'
            ]
        ];
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        $res=Weixin::HttpsPost($url,$data);
        echo $res;
    }

    public function set()
    {
        $token=Weixin::gettoken();
        $url="https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=$token";
        $open=Weixin::setAllUser();
        $data=[
            "openid_list"=>$open,
            "tagid"=>100,
        ];
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        $res=Weixin::HttpsPost($url,$data);
        echo $res;
    }

    public function aa()
    {
        $token=Weixin::gettoken();
        $url="https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=$token";
        $data=[
            "filter"=>[
                "is_to_all"=>false,
                "tag_id"=>100
            ],
            "text"=>[
                "content"=>"大家好"
            ],
            "msgtype"=>"text",
        ];
        $data=json_encode($data,JSON_UNESCAPED_UNICODE);
        $res=Weixin::HttpsPost($url,$data);
        echo $res;
    }

    public function template()
    {
        $token=Weixin::gettoken();
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$token";
        $data=[
                "touser"=>"OPENID",
                "template_id"=>"WrSqGKof3yan696e2m9FIKqZBVKG7eLZiSJ821091IQ",

           "data"=>[
                "first"=>[
                    "value"=>"恭喜你购买成功！",
                       "color"=>"#173177"
                   ],
                   "keyword1"=>[
                     "value"=>"巧克力",
                       "color"=>"#173177"
                   ],
                   "keyword2"=>[
                    "value"=>"39.8元",
                    "color"=>"#173177"
                   ],
                   "keyword3"=>[
                    "value"=>"2014年9月22日",
                       "color"=>"#173177"
                   ],
                   "remark"=>[
                    "value"=>"欢迎再次购买！",
                       "color"=>"#173177"
                   ]
           ]
        ];
    }
}
