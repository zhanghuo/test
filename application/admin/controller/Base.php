<?php
namespace app\admin\controller;

use think\Db;
use think\Request;
use think\Url;
use think\Controller;
use think\Session;

class Base extends Controller
{
    protected function _initialize()
    {
        if (!Session::has("manage_id")) {
            $this->redirect("admin/Login/login");
        } else {
            //全局权限

            $authmenu = new \think\Authmenu();
            $uid = Session::get('manage_id');

            $auth=$authmenu->check(1);
            if (!$auth[0]) {
                $this->error($auth[1]);
            }
            $this->assign('menu_left', $auth[1]);
            $this->assign('mate_title', $auth[3]);
            $this->assign('mate_operate', $auth[2]);

          /*  $user = db::name('manager')->field('id,username,avatar,nickname,mobile')->find($uid);*/
            $this->assign('user', 1);

        }
    }
    public function index(){
      return  $this->fetch("index",['mate_title'=>1]);
    }

}
