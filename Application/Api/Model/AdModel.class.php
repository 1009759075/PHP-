<?php
/**
 * Created by PhpStorm.
 * User: wang(shimin.wang@foxmail.com)
 * Date: 2017/5/11
 * Time: 16:15
 */

namespace Api\Model;


use Think\Model;

class AdModel extends  Model
{
    public $tableName = 'ad';

    /* 广告位置 */
    public $locations = array(
        'Index_Top' => '首页/顶部',
        'Index_Bottom'  => '首页/底部',
        'Movie_Index_Top'   => '电影/首页/顶部',
        'Movie_Index_Right_One'   => '电影/首页右侧/专栏',
        'Movie_Index_Hot'   => '电影/首页/热推'
    );
}