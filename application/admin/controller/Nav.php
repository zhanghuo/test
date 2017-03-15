<?php
namespace app\admin\controller;

use app\admin\model\Nav as navmodel;
use app\admin\model\Navclass as navclassmodel;
use think\Model;
use think\Request;
use think\Config;


class Nav extends Base{
    public function index(){
        $data = (new navmodel())->paginate(10);
        return $this->fetch("index",['list'=>$data]);
    }

    public function create(){
        if(Request::instance()->isPost()){
            $data = Request::instance()->post();
            if((new navmodel())->save($data)){
                $this->success("添加成功","Nav/index");
            }else{
                $this->error("添加失败","Nav/index");
            }
        }else{
            $navclass =(new navclassmodel())->select();
            return $this->fetch('create',['navclass'=>$navclass]);
        }

    }


    public function delete(){
        $id = Request::instance()->param("id");
        if((new navmodel())->destroy($id)){
            $this->success("删除成功","Nav/index");
        }else{
            $this->error("删除失败","Nav/index");
        }
    }

    public function update($id){
        if(Request::instance()->isPost()){
            $data = Request::instance()->post();
           if((new navmodel())->save($data,$id)){
               $this->success("修改成功","Nav/index");
           }else{
               $this->error("修改失败","Nav/index");
           }
        }else{

            $data = (new navmodel())->get($id);
            return $this->fetch("create",['vo'=>$data]);
        }
    }

}