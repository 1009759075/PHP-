<?php
/**
 * Created by PhpStorm.
 * User: wang(shimin.wang@foxmail.com)
 * Date: 2017/5/11
 * Time: 15:50
 */

namespace Api\Controller;


class AdController extends  baseController
{
    public function __construct()
    {
        parent::__construct();
        $this->adModel = D("ad");
    }


    /**
     * 获取列表
     * @param integer $start // 从第几个开始，默认0
     * @param integer $count // 取多少条数据，默认10条，最多10条
     * @param String $types  //广告位置
     */

    public function getList()
    {
        $type = I('get.type','','trim');
        if(empty($type)){
           error(baseController::Miss_Arguments,'请选择广告位');
        }
        if(!isset($this->adModel->locations[$type])){
            error(baseController::Invalid_Arguments,'请选择广告位');
        }
        $start = I('get.start',0,'intval');
        $count = I('get.count',10,'intval');
        if($start > 1){
            $start = 1;
        }
        if($count > 10){
            $count = 10;
        }
        $where['location'] = $type;
        $where['_string'] = '(start_time=0 OR (start_time > 0 && start_time <= "'. time() .'")) and (stop_time=0 OR (stop_time>0 AND stop_time>="'.time().'"))  ';
        $list = $this->adModel->where($this->deal_where($where))->order('sort_order ASC,add_time DESC')->limit($start , $start+$count)->field('title,image,url')->select();

        if(empty($list)){
            error(baseController::NOT_EXISTS,'没有相关数据');
        }
        success($list);
    }

}