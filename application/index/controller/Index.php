<?php
namespace app\index\controller;
use app\common\model\Message;
use think\Controller;


class Index extends Controller
{
    public function index()
    {

        $message = new Message();
        $messages = $message->paginate(10);
        $viewData = [
            'messages' => $messages
        ];
        $this->assign($viewData);

        return view();
        
    }

    /* 增加留言 */
    public function add()
    {
        if (request()->isAjax()) {


            $data = [
                'content' => input('post.message'),
            ];
            
            $message = new Message();
            $result = $message->add($data);
            if($result == 1) {
                $this->success('留言成功', 'index/index/index');
            } else {
                $this->error($result);
            }

        }
        return view();

    }

    /* 删除留言 */
    public function del()
    {
        $id = input('id');
        $message = new Message();
        $result =  $message->find($id)->delete();
        if ($result) {
            $this->success('删除成功', 'index/index/index');

        } else {
            $this->error('删除失败');
        }

    }

    /* 修改留言 */
    public function mod()
    {
        $messages = new Message();

        if (request()->isAjax()) {
            $data = [
                'id' => input('id'),
                'content' => input('message'),
            ];
            $result = $messages->edit($data);
            if ($result == 1) {
                $this->success('修改成功', 'index/index/index');
            } else {
                $this->error($result);
            }
        }

        $message = $messages->find(input('id'));
        $viewData = [
            'message' => $message,
        ];
        $this->assign($viewData);
        return view();

    }


    
}
