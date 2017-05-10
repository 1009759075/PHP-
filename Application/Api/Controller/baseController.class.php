<?php
/**
 * Created by PhpStorm.
 * User: wang(shimin.wang@foxmail.com)
 * Date: 2017/5/10
 * Time: 15:42
 */
namespace Api\Controller;

use Api\ORG\response;
use Think\Controller;

class baseController extends Controller
{
    public $where = array();

    /**
     * 合并Where条件
     * @param array $param
     * @return array
     */
    function deal_where($param=array()){
        if(empty($param) || is_null($param) || is_string($param)){
            $param = array();
        }
        return array_merge($this->where,$param);
    }

    /**
     * 空操作处理
     * @param $name
     */
    public function _empty($name){
        response::error(response::Empty_Method,'非法请求');
    }
}