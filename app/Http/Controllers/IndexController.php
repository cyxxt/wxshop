<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Category;
use Illuminate\Support\Facades\DB;
use App\Model\Cart;
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
        $cate_id=$request->cate_id;
        $order=$request->order;
        $ziduan=$request->ziduan;
        echo $ziduan;
//        echo $cate_id;
        if(empty($cate_id)){
            if(empty($type)){
                $goodsInfo=Goods::get();
            }else{
                $goodsInfo=Goods::orderBy($ziduan,$order)
                    -> take(10)->get();
            }


//        echo $type;
//            if($type==1){
//                $goodsInfo=Goods::orderBy('goods_num','desc')
//                    -> take(10)->get();
//            }
//            if($type==2){
//                $goodsInfo=Goods::orderBy('create_time','asc')
//                    -> take(10)->get();
//            }
//            if($type==3){
//                $goodsInfo=Goods::orderBy('self_price',$type)
//                    -> take(10)->get();
//            }
        }else{
            $goodsInfo=$this->getcate1($cate_id);
        }
        return view('div',['goodsInfo'=>$goodsInfo]);
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
            'user_id'=>$user_id
        ];
        $goodsInfo=Cart::join('goods','goods.goods_id','=','cart.goods_id')->where($where)->get();
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
                    'buy_number'=>1
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
                    'buy_number'=>$buy_num
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
}
