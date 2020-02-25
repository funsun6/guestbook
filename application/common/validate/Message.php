<?php

namespace app\common\validate;

use think\Validate;

class Message extends Validate
{

	protected $rule = [
        'content|内容' => 'require|max:35',
    ];
    
 
    protected $scene = [
        'add' => ['content'],
        'edit' => ['content']
    ];
}
