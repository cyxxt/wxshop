<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $table="menu";
    protected $primaryKey="m_id";
    public static function getPidInfo($id)
    {
        $data=self::where('p_id',$id)->get()->toArray();
        return $data;
    }
}
