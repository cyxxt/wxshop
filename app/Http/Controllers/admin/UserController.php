<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Weixin;
use Illuminate\Support\Facades\Storage;
use App\Model\News;
use App\Model\Goods;
use App\Model\Menu;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('admin.index');
    }
    public function event()
    {
        return view('admin.event');
    }
    public function type()
    {
        $type=config('type.subscribe');
        return view('admin.type',['type'=>$type]);
    }

    public function typedo(Request $request)
    {
        $type=$request->type;
//        echo $type;
        $config=[];
        $config['subscribe']=$type;
        $str="<?php return ".var_export($config,true).';';
        $path=config_path('type.php');
        $res=file_put_contents($path,$str);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    public function doadd(Request $request)
    {
//        $token=Weixin::gettoken();
//        $data=[
//            'appid'=>'wxfab69887a39d877b'
//        ];
//        $data=json_encode($data);
//        $url="https://api.weixin.qq.com/cgi-bin/clear_quota?access_token=$token";
//        $re=Weixin::HttpsPost($url,$data);
//        dd($re);die;
        $file=$request->img;
        if(!empty($file)){

            $arr=Weixin::up($file);

            $data=$arr['data'];
            $newfilename=$arr['imgpath'];
//            echo 2;die;
            if($request->hasFile('img')){

                $title=$request->input('title',null);
//                    echo $title;
                $content=$request->input('content',null);
                $url1=$request->input('url',null);
                $token=Weixin::gettokren();
                $type=Weixin::gettype($data);
                $url="https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$token&type=$type";
                $arr=[
                    'media'=>new \CURLFile(realpath($newfilename))
                ];
//            print_r($arr);
                $re=Weixin::HttpsPost($url,$arr);
//            dd($re);
                $dat=json_decode($re,true);
//                print_r($dat);
                $media_id=isset($dat['media_id'])?$dat['media_id']:null;
//            echo $media_id;die;
                $urll=isset($dat['url'])?$dat['url']:null;
                $dataa=[
                    'title'=>$title,
                    'content'=>$content,
                    'media_id'=>$media_id,
                    'type'=>$request->input('type',null),
                    'img'=>$urll,
                    'url'=>$url1,
                ];
                $ress=News::insert($dataa);
            }
        }else{
//            echo 1;die;
            $content=$request->input('content');
            $data=[
                'content'=>$content,
                'type'=>'text'
            ];
            $ress=News::insert($data);
        }
    }

    public function menu()
    {
        $menu=Menu::getPidInfo(4);
        return view('admin.menu',['menu'=>$menu]);
    }

    public function menudo(Request $request)
    {
        $arr=$request->all();
//        print_r($arr);die;
        unset($arr['_token']);
        $res=Menu::insert($arr);
        if($res){
            echo 1;
            return redirect('amdin.menulist');
        }else{
            echo 2;
        }
    }
    public function getMenuList()
    {
        $token=Weixin::gettoken();
        $url="https://api.weixin.qq.com/cgi-bin/menu/get?access_token=$token";
//        echo $url;
        $str='{"menu":{"button":[{"type":"click","name":"蔡徐坤","key":"V1001_TODAY_MUSIC","sub_button":[]},{"name":"菜单","sub_button":[{"type":"view","name":"搜索","url":"http:\/\/www.soso.com\/","sub_button":[]},{"type":"miniprogram","name":"wxa","url":"http:\/\/mp.weixin.qq.com","sub_button":[],"appid":"wx286b93c14bbf93aa","pagepath":"pages\/lunar\/index"},{"type":"click","name":"赞一下我们","key":"V1001_GOOD","sub_button":[]}]}]}}';
        $data=json_decode($str,true)['menu']['button'];
        $arr=[];
        $arr1=[];
        //获取一级菜单
        foreach ($data as $key=>$value){
            $arr[$key]['p_id']=4;
            $arr[$key]['m_name']=$value['name'];
            $arr[$key]['type']=isset($value['type'])?$value['type']:null;
            $arr[$key]['url']=isset($value['url'])?$value['url']:null;
            $arr[$key]['key']=isset($value['key'])?$value['key']:null;
            //循环二级菜单
            if(!empty($value['sub_button'])){
                foreach ($value['sub_button'] as $k=>$v){
//                    print_r($v);
                    $arr1[$k]['p_id']=$key;
                    $arr1[$k]['m_name']=$v['name'];
                    $arr1[$k]['type']=isset($v['type'])?$v['type']:null;
                    $arr1[$k]['url']=isset($v['url'])?$v['url']:null;
                    $arr1[$k]['key']=isset($v['key'])?$v['key']:null;
                }
            }
        }
//        print_r($arr);
//        print_r($arr1);
        foreach ($arr as $value){
            Menu::insert($value);
        }
        foreach($arr1 as $value){
            Menu::insert($value);
        }
    }

    public function menulist()
    {
        $menu=Menu::get();
        return view('admin.menulist',['menu'=>$menu]);
    }

    public function getmenu(Request $request)
    {
        $menuid=$request->menuid;
//        echo $menuid;
        $arr=Menu::where('p_id',$menuid)->get()->toArray();
        return json_encode($arr);
    }

}
