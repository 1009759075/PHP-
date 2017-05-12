<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/5/12
 * Time: 12:44
 */
namespace Api\Model;
use Think\Model;
class BaseModel extends Model{
    const OPTION_ERROR='请求控制器的参数必须是数组';
    const PAGESIZE=10;  //每页条数
    //模型返回成功方法
    public function Model_success_return($code='1',$data=array(),$msg=""){
        return array(
            'code'=>$code,
            'data'=>$data,
            'msg'=>$msg,
        );
    }
    //模型返回错误方 法状态默认1001
    public function Model_error_return($code='1001',$data=array(),$msg=""){
        return array(
            'code'=>$code,
            'data'=>$data,
            'msg'=>$msg,
        );
    }

}