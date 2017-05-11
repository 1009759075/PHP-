<?php
/**
 * Created by PhpStorm.
 * User: wang(shimin.wang@foxmail.com)
 * Date: 2017/5/10
 * Time: 15:42
 */
namespace Api\Controller;

use Think\Controller;

class baseController extends Controller
{
    const Success = 200;

    /*缺少必选参数*/
    const Miss_Arguments = 12;

    /*参数无效，例如：需要传入的是数字类型的，却传入了字符类型的参数*/
    const Invalid_Arguments = 13;

    /* 查询不到数据 */
    const NOT_EXISTS = 14;

    /* 权限不足、非法访问 */
    const Invalid_Permission = 25;

    /* 空控制器 */
    const Empty_Controller = 97;

    /* 空操作 */
    const Empty_Method = 98;

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
        error(baseController::Empty_Method,'非法请求');
    }
}