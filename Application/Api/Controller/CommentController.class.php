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
        $option=array();    //声明接收的参数为数组格式
        $option['medium_id']=I('get.medium_id');
        $option['types']=I('get.types');
        $option['page']=I('get.page',1);
        $option['page_size']=I('get.page_size',10);
        $res=$this->commentModel->get_level1_comment($option);
        if(!$res){
            $code=$this->commentModel->getError();
            if($code==13){
                $msg='medium_id或者types为必填项';
            }
            if($code==14){
                $msg='查不到数据内容';
            }
            error($code,$msg);
        }else{
            success($res);
        }

    }
    
}