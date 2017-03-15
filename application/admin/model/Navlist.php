<?php

namespace app\admin\model;
use think\Model;
class Navlist extends model{
   protected $insert = [
        "add_time"
    ];

    protected function setAddTimeAttr(){
        return time();
    }
    /*// 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;
    // 关闭自动写入update_time字段
    protected $addTime = true;*/
}