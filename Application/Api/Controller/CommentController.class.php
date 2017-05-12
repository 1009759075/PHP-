<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/5/12
 * Time: 12:38
 */
namespace Api\Controller;
use Think\Controller;

class CommentController extends baseController{
    protected  $commentModel='';
    public function __construct()
    {
        parent::__construct();
        $this->commentModel=D('Comment');

    }
    public function get_comment(){
        $option='';
        $option['medium_id']=I('post.medium_id');
        $option['page']=I('post.page',1);
        $res=$this->commentModel->get_level1_comment($option);
        if($res['code']<>1){
            error($res['code'],$res['msg']);
        }else{
            success($res['data'],$res['msg']);
        }

    }
    
}