<?php

namespace app\admin\controller;

use think\Request;
use think\Session;
use app\admin\model\Login as loginmodel;
class Login extends \think\Controller
{
    protected $beforeActionList = [
        "checkLogin"=>['only'=>"login"]
    ];
    //注入
    public function login(Request $param,loginmodel $loginmodel)
    {
        if(Request::instance()->isPost()){
            if($loginmodel::login()){
                $this->success('登录成功', 'admin/Base/index');
            }else{
                $this->error('登录失败');
            }
        }
            return $this->fetch("login", ["title" => "注册页面"]);

    }
    protected function checkLogin(){
        if(Session::has("mange_id")){
            $this->redirect("admin/Base/index");
        }
    }
}