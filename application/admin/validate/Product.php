<?php
namespace app\admin\validate;

use think\Validate;

class Product extends Validate
{
    protected $rule = [
        "title|标题" => "require",
    ];
}
