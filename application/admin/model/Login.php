<?php

namespace app\admin\model;

use think\Model;
use think\Request;
use think\Db;
use think\Session;


class Login extends model
{


    public static function login()
    {
        $param = Request::instance()->param();
        $map = [
            "username" => $param["username"],
            "password" => $param["password"]
        ];
        $data = self::where($map)->find();

          if($data){
            Session::set('manage_id',$data['id']);
            return true;
        }
        return false;
    }


}