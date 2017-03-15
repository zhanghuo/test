<?php
namespace app\admin\controller;

use app\admin\model\Navlist as navlistmodel;
use app\admin\model\Navclass as navclassmodel;
use think\Model;
use think\Request;
use think\Config;


class Navlist extends Base{
    public function index(){
        $data = (new navlistmodel())->paginate(1);
        return $this->fetch("index",['list'=>$data]);
    }

    public function create(){
        if(Request::instance()->isPost()){
            $data = Request::instance()->post();
            if((new navlistmodel())->save($data)){
                $this->success("添加成功","Navlist/index");
            }else{
                $this->error("添加失败","Navlist/index");
            }
        }else{
            $navclass =(new navclassmodel())->select();
            dump($navclass);
            return $this->fetch('create',['navclass'=>$navclass]);
        }

    }


    public function delete(){
        $id = Request::instance()->param("id");
        if((new navlistmodel())->destroy($id)){
            $this->success("删除成功","Navlist/index");
        }else{
            $this->error("删除失败","Navlist/index");
        }
    }

    public function update($id){
        if(Request::instance()->isPost()){
            $data = Request::instance()->post();
           if((new navlistmodel())->save($data,$id)){
               $this->success("修改成功","Navlist/index");
           }else{
               $this->error("修改失败","Navlist/index");
           }
        }else{

            $data = (new navlistmodel())->get($id);
            return $this->fetch("create",['vo'=>$data]);
        }
    }

}