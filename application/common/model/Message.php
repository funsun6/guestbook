<?php

namespace app\common\model;

use think\Model;

class Message extends Model
{
    //
    public function add($data)
    {
        $validate = new \app\common\validate\Message();
        if(!$validate->scene('add')->check($data)) {
            return $validate->getError();
        }
        $result = $this->allowField(true)->save($data);
        if($result) {
            return 1;
        } else {
            return '留言失败';
        }
    }

    public function edit($data)
    {
        $validate = new \app\common\validate\Message();
        if (!$validate->scene('edit')->check($data)) {
            return $validate->getError();
        }
        $message = $this->find($data['id']);
        $message->content = $data['content'];
        $result = $message->save();
        if ($result) {
            return 1;
        } else {
            return '编辑失败';
        }
    }
}
