<?php
/**
 * Created by PhpStorm.
 * User: wang(shimin.wang@foxmail.com)
 * Date: 2017/5/10
 * Time: 17:29
 */

namespace Api\Controller;

use Api\ORG\response;

class EmptyController extends baseController
{
    /**
     * 空控制器处理
     */
    public function index(){
        response::error(response::Empty_Controller , '非法请求');
    }
}