<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Category;
use Illuminate\Support\Facades\DB;
use App\Model\Cart;
use App\Model\Address;
use Memcache;
class IndexController extends Controller
{
    //首页
    public function index(Request $request){
//        $arr=DB::table('goods')->get();
        $arr=Goods::orderBy('goods_id','desc')
            -> take(2)->get();
//        print_r($arr);
        $cateInfo=Category::where('pid',0)->take(6)->get();
       return view('index',['arr'=>$arr,'cateInfo'=>$cateInfo]);
    }
    //潮购
    public function userpage(){
        return view('userpage');
    }
    //潮购
    public function userpages(){

        return view('userpages');
    }
    //所有商品
    public function allshops(Request $request)
    {
        $topInfo=Category::where('pid',0)->get();
        $token=$request->_token;
//        dd($cateInfo);

        $goodsInfo=Goods::get();
        return view('allshops',['topInfo'=>$topInfo,'goodsInfo'=>$goodsInfo]);
    }
//ajax
    public function allshopsdo(Request $request)
    {
        $cate_id=$request->input('cate_id');
//        echo $cate_id;die;
        $topInfo=Category::where('pid',0)->get();
        $type=$request->type;
//        echo $cate_id;
        if(empty($cate_id)){
            if(empty($type)){
                $goodsInfo=Goods::get();
            }else{

                if($type==1){
                    $goodsInfo=Goods::orderBy('goods_num','desc')
                        -> take(10)->get();
                }
                if($type==2){
                    $goodsInfo=Goods::orderBy('create_time','asc')
                        -> take(10)->get();
                }
                if($type==3){
                    $goodsInfo=Goods::orderBy('self_price',$type)
                        -> take(10)->get();
                }
            }
        }else{
            if(empty($type)){
                $goodsInfo=$this->getcate1($cate_id);
            }

        }
        return view('div',['goodsInfo'=>$goodsInfo,'topInfo'=>$topInfo]);
    }
//    首页跳的所有商品页面
    public function allshopsdoo(Request $request)
    {
        $cate_id=$request->input('cate_id');
//        echo $cate_id;die;
        $topInfo=Category::where('pid',0)->get();
        $type=$request->type;
//        echo $cate_id;
        if(empty($cate_id)){
            if(empty($type)){
                $goodsInfo=Goods::get();
            }else{

                if($type==1){
                    $goodsInfo=Goods::orderBy('goods_num','desc')
                        -> take(10)->get();
                }
                if($type==2){
                    $goodsInfo=Goods::orderBy('create_time','asc')
                        -> take(10)->get();
                }
                if($type==3){
                    $goodsInfo=Goods::orderBy('self_price',$type)
                        -> take(10)->get();
                }
            }
        }else{
            if(empty($type)){
                $goodsInfo=$this->getcate1($cate_id);
            }

        }
        return view('div1',['goodsInfo'=>$goodsInfo,'topInfo'=>$topInfo]);
    }
//根据id获取商品数据
    public function getcate1($cate_id)
    {
//        echo $cate_id;
        $cateInfo=Category::get();
//        print_r($cateInfo);
        $cate_id=$this->getSonCateId($cateInfo,$cate_id);
//            print_r($cate_id);
        $goodsInfo=[];
        foreach($cate_id as $v){
            $data=Goods::where('cate_id','=',$v)->first();
            if(!empty($data)){
                $goodsInfo[]=$data;
            }
        }
        return $goodsInfo;
    }
    //购物车
    public function shopcart()
    {
        $user_id=session('user_id');
        $where=[
            'user_id'=>$user_id,
            'cart_status'=>1
        ];
        $goodsInfo=Cart::join('goods','goods.goods_id','=','cart.goods_id')->orderBy('cart.create_time','desc')->where($where)->get();
//        print_r($goodsInfo);die;
        $goodsInfo1=Goods::orderBy('goods_num','desc')->take(4)->get();
        return view('shopcart',['goodsInfo'=>$goodsInfo,'goodsInfo1'=>$goodsInfo1]);
    }
    //详情页
    public function shopcontent(Request $request)
    {
        $goods_id=$request->goods_id;
//        echo $goods_id;
        $arr=Goods::where('goods_id',$goods_id)->first();
//        print_r($arr);
        return view('shopcontent',['arr'=>$arr]);
    }



//获取分类id
    public function getSonCateId($cateInfo,$pid){
        static $cate_id=[];
        foreach($cateInfo as $k=>$v){
            if($v['pid']==$pid){
                $cate_id[]=$v['cate_id'];
                $this->getSonCateId($cateInfo,$v['cate_id']);
            }
        }
        return $cate_id;

    }

    //添加购物车
    public function cart(Request $request)
    {
        $user_id=session('user_id');
        if(empty($user_id)){
            echo 3;
        }else{
            $goods_id=$request->goods_id;
//            echo $goods_id;die;
            $res=Cart::where('goods_id',$goods_id)->first();
            if(empty($res)){
                $data=[
                    'goods_id'=>$goods_id,
                    'user_id'=>$user_id,
                    'buy_number'=>1,
                    'create_time'=>time()
                ];
                $res1=Cart::insert($data);

            }else{
                $where=[
                    'goods_id'=>$goods_id,
                    'user_id'=>$user_id,

                ];
                $res=Cart::where($where)->first();
                $buy_num='';
                $buy_num.=$res['buy_number']+1;
                $data=[
                    'buy_number'=>$buy_num,
                    'cart_status'=>1,
                    'create_time'=>time()
                ];
                $res1=Cart::where('goods_id',$goods_id)->update($data);
            }
            if($res1){
                echo 1;
            }else{
                echo 2;
            }
        }
    }

    //搜索
    public function search(Request $request)
    {
        $search=$request->search;
//        echo $search;
        if(empty($search)){
            $goodsInfo=Goods::get();
        }else{
            $goodsInfo=Goods::where('goods_name','like',"%$search%")->get();
        }
        return view('div',['goodsInfo'=>$goodsInfo]);
    }

    //删除购物车里的商品
    public function del(Request $request)
    {
        $goods_id=$request->goods_id;
//        echo $goods_id;die;
        $user_id=session('user_id');
        $where=[
            'goods_id'=>$goods_id,
            'user_id'=>$user_id
        ];
        Cart::where($where)->update(['cart_status'=>2,'buy_number'=>0,'create_time'=>0]);
    }

    //加
    public function jia(Request $request)
    {
        $price=$request->price;
//        echo $price;
        $goods_id=$request->goods_id;
//        echo $goods_id;
        $user_id=session('user_id');
        $where=[
            'goods_id'=>$goods_id,
            'user_id'=>$user_id
        ];
        $data=[
            'buy_number'=>$price
        ];
        Cart::where($where)->update($data);
    }

    //删除全部
    public function delall(Request $request)
    {
        $type=$request->type;
        if($type==2){
            $goods_id=$request->goods_id;
//        echo $goods_id;die;
            $user_id=session('user_id');
            $goods_id=explode(',',$goods_id);
//        print_r($goods_id);
            $res=Cart::where('user_id',$user_id)->whereIn('goods_id',$goods_id)->update(['cart_status'=>2]);
            if($res){
                echo 1;
            }
        }else{
            $goods_id=$request->goods_id;
            echo $goods_id;
        }


    }

    //支付页面
    public function payment()
    {
        $goods_id=session('goods_id');
//        echo $goods_id;die;
        $user_id=session('user_id');
        $goods_id=explode(',',$goods_id);
//        print_r($goods_id);die;
//        $where=[
//            'cart.goods_id'=>['in',$goods_id]
//        ];
//        print_r($where);die;
        $goodsInfo=Cart::join('goods','goods.goods_id','=','cart.goods_id')->whereIn('cart.goods_id',$goods_id)->get();
//        print_r($goodsInfo);die;
        $price=0;
        foreach($goodsInfo as $v){
            $price+=$v['buy_number']*$v['self_price'];
        }
        $addWhere=[
            'user_id'=>$user_id,
            'is_default'=>1
        ];
        $addressInfo=Address::where($addWhere)->get();

        return view('payment',['goodsInfo'=>$goodsInfo,'price'=>$price,'addressInfo'=>$addressInfo]);
    }
//点击结算存session
    public function paymentdo(Request $request)
    {
        $goods_id=$request->goods_id;
        session(['goods_id'=>$goods_id]);
//        echo $goods_id;
    }

    //支付成功页面
    public function paysuccess()
    {
        return view('paysuccess');
    }
    ////潮购记录
    public function recorddetail()
    {
        return view('recorddetail');
    }
    //我的钱包
    public function mywallet()
    {
        return view('mywallet');
    }
}
