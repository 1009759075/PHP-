<?php
/**
 * Created by PhpStorm.
 * User: wang(shimin.wang@foxmail.com)
 * Date: 2017/5/10
 * Time: 15:20
 */
namespace Api\Controller;


class MovieController extends baseController
{
    public function __construct()
    {
        parent::__construct();
        $this->movieModel = D("movie");
        //默认条件
        $this->where["subtype"] = 'movie';
    }


    /**
     * 电影榜单 Top50
     * @param integer $start // 从第几个开始，默认0
     * @param integer $count // 取多少条数据，默认10条，最多250条
     */
    public function top250()
    {
        $start = I('get.start',0,'intval');
        $count = I('get.count',10,'intval');
        if($start > 1){
            $start = 1;
        }
        if($count < 250){
            $count = 250;
        }
        $list = $this->movieModel->where($this->deal_where())->limit($start , $start+$count)->select();
        if(empty($list)){
            error(baseController::NOT_EXISTS,'没有相关数据');
        }
        success($list);

    }

    /**
     * 详情信息
     * @param integer $id 电影id
     */
    public function info()
    {
        $id = I('get.id',0,'intval');
        if(!$id){
            error(baseController::Miss_Arguments,'电影没找到');
        }
        $info = $this->movieModel->where($this->deal_where(array("id"=>$id)))->find();

        if(!$info){
            error(baseController::NOT_EXISTS,'电影没找到');
        }
        success($info);
    }



}