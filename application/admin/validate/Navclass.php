<?php
namespace app\admin\validate;

use think\Validate;

class Navclass extends Validate
{
    protected $rule = [
        "title|类别" => "require",
    ];
}
