<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $table='cart';
    public $timestamps=false;


    public $primaryKey='cart_id';
}
