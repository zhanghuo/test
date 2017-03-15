<?php
namespace app\admin\validate;

use think\Validate;

class Banner extends Validate
{
    protected $rule = [
        "picurl|图片" => "require",
    ];
}
