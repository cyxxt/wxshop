<?php

namespace App\Http\Controllers\address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    //收货地址页面
    public function address(){
        return view('address.address');
    }
    public function addre(){
        return view('address.addre');
    }

    public function addaddress(Request $request)
    {

    }
}
