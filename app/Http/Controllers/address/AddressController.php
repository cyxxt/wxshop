<?php

namespace App\Http\Controllers\address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Memcache;
use App\Model\Area;
use App\Model\Address;

class AddressController extends Controller
{
    //收货地址页面
    public function address(){
        return view('address.address');
    }
//    收货地址的添加
    public function adddo(Request $request)
    {
        $arr=$request->all();
//        print_r($arr);
//        echo $arr['_default'];die;
        $user_id=session('user_id');
        $data=[
            'address_name'=>$arr['uname'],
            'address_tel'=>$arr['tel'],
            'address_szqy'=>$arr['demo'],
            'address_detail'=>$arr['addsc'],
            'user_id'=>$user_id,
            'is_default'=>$arr['is_default'],
        ];
        if($arr['is_default']==1){
            $res=Address::where('user_id',$user_id)->update(['is_default'=>2]);
            $res1=Address::insert($data);
        }else{
            $res=Address::insert($data);
        }

        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
//    地址管理
    public function addre(){
       $where=[
           'user_id'=>session('user_id')
       ];
        $arr=Address::where($where)->get();

        return view('address.addre',['arr'=>$arr]);
    }
    //删除
    public function adddel(Request $request)
    {
        $address_id=$request->address_id;
//        echo $address_id;die;
        $user_id=session('user_id');
        $where=[
            'user_id'=>$user_id,
            'address_id'=>$address_id
        ];
        $res=Address::where($where)->delete();
        if($res==1){
           echo 1;
        }else{
            echo 2;
        }
    }

    //设为默认
    public function defaults(Request $request)
    {
        $address_id=$request->address_id;
//        echo $address_id;die;
        $user_id=session('user_id');
        $where=[
            'user_id'=>$user_id,
            'address_id'=>$address_id
        ];
        $res=Address::where('user_id',$user_id)->update(['is_default'=>2]);
        $res2=Address::where($where)->update(['is_default'=>1]);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }

    //点击编辑
    public function addressedit(Request $request)
    {
        $address_id=$request->address_id;
//        echo $address_id;die;
        $where=[
            'address_id'=>$address_id
        ];
        $arr=Address::where($where)->first();
        return view('address.addressedit',['arr'=>$arr]);
    }

    //修改执行
    public function editdo(Request $request)
    {
        $data=$request->all();
        unset($data['_token']);
//        print_r($data);
        $user_id=session('user_id');
//        echo $data['address_id'];die;
        $where=[
            'user_id'=>$user_id,
            'address_id'=>$data['address_id']
        ];
        if($data['is_default']==1){
            $res1=Address::where('user_id',$user_id)->update(['is_default'=>2]);

        }
        $res=Address::where($where)->update($data);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    public function addaddress(Request $request)
    {

    }
}
