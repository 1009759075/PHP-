<?php

namespace Api\Controller;

use Api\ORG\response;

class IndexController extends baseController
{

    public function index() {
        $strat=empty(I('get.strat'))?I('get.strat'):0;//开始的位置
        $end=empty(I('get.end'))?I('get.end'):0;//结束的位置
        /*
         * 这里需要注意，$stratr和$end 变量需要利用TP框架去进行接收值，
         * 请使用get方式传递值，KEY名称请参照I函数中的get.字符串后面的名称即：
         * I('get.key名称值')
         */
        $broadcast=D('broadcast');//数据库名表称为app_boradcast
        $user = D('user');
        $tOne=$user->trueTableName;//获取到模型中的完整表名称
        $tTwo=$broadcast->trueTableName;//获取到模型中的完整表名称
        $count= $broadcast->count();// 查询总条数备用，如果需要请协商解决
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $broadcast->/*where('确定显示的条件')->order('根据那个字段排序')->*/
                limit($strat.','.$end)->
                /*确定显示的开始条数       结束条数*/
                join($tOne.' ON '.$tTwo.'.user_id = '.$tOne.'.id')->
                /*利用join方法进行多表联合查询
                 * 根据user表的id与broadcast表的user_id字段的值向等的数据
                 */
                select();

        response::success($list);
//        $jsons=json_encode($list);//提取数据转换json数据

//        return $jsons;//返回json数据，只要被触发就会返回相应数据。具体请参考数据库
        /*
         * 因为使用多表联合查询方式，所以需要两个数据库的字段名称进行同时查看
         * 基本格式与Iden给定数据库字段格式一致，如需调整请告知
         * 如有其他疑问，请联系电话：15754889527  （同时为微信账号）
         */
        
        
    }
}