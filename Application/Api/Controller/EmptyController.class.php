<?php
/**
 * Created by PhpStorm.
 * User: wang(shimin.wang@foxmail.com)
 * Date: 2017/5/10
 * Time: 17:29
 */

namespace Api\Controller;

class EmptyController extends baseController
{
    /**
     * 空控制器处理
     */
    public function index(){
        error(baseController::Empty_Controller , '非法请求');
    }
}