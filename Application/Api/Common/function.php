<?php

/**
 * 错误输出
 * @param integer $code 错误码，必填
 * @param string $msg   错误信息
 */
function error($code , $msg='',$OutputType='json'){
    $returnData = array(
        'code' => $code ,
        'msg'  => $msg,
        'data' => ''
    );
    encodeData($returnData , strtolower($OutputType));
    exit($returnData);
}

/**
 * 成功返回
 * @param $data
 */
function success( $data , $OutputType='json')
{
    $returnData = array(
        'code' => \Api\Controller\baseController::Success,
        'msg'  => '',
        'data' => $data
    );
    encodeData($returnData , strtolower($OutputType));
    exit($returnData);
}

/**
 * 编码数据
 * @access protected
 * @param mixed $data 要返回的数据
 * @param String $type 返回类型 JSON XML
 * @return string
 */
function encodeData(&$data,$type='json') {
    if(empty($data))  return '';
    if('json' == $type) {
        // 返回JSON数据格式到客户端 包含状态信息
        $data = json_encode($data);
        header('Content-Type: application/json; charset=utf-8');//设置页面输出的CONTENT_TYPE和编码
    }elseif('xml' == $type){
        // 返回xml格式数据
        $data = xml_encode($data);
        header('Content-Type: application/xml; charset=utf-8');//设置页面输出的CONTENT_TYPE和编码
    }
    return $data;
}


