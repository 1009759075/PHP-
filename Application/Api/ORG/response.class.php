<?php
/**
 * API输出类(2017.5.11废弃)
 */

namespace Api\ORG;

class response
{
    /*缺少必选参数*/
    const Miss_Arguments = 12;

    /*参数无效，例如：需要传入的是数字类型的，却传入了字符类型的参数*/
    const Invalid_Arguments = 13;

    /* 查询不到数据 */
    const NOT_EXISTS = 14;

    /* 权限不足、非法访问 */
    const  Invalid_Permission = 25;

    /* 空控制器 */
    const Empty_Controller = 97;

    /* 空操作 */
    const Empty_Method = 98;


    /**
     * 错误输出
     * @param integer $code 错误码，必填
     * @param string $msg   错误信息
     */
    public static function error($code , $msg=''){
        $returnData = array(
            'code' => $code ,
            'msg'  => $msg,
        );
        header('Content-Type:text/json; charset=utf-8');
        exit(json_encode($returnData));
    }

    /**
     * 成功返回
     * @param $data
     */
    public static function success( $data )
    {

	   header('Content-Type:text/json; charset=utf-8');
       exit(json_encode($data));
    }
}