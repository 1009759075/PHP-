<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/5/12
 * Time: 12:40
 */
namespace Api\Model;
use Think\Model;
class CommentModel extends Model{


    //获取一级评论
    public function get_level1_comment($option){
        $field='b.id,b.content,b.star,b.like,bb.content upper_level_content,bb.id upper_level_id,u.name user_name,u.id user_id,uu.name upper_level_user_name,uu.id upper_level_user_id';
        //参数必须是数组
        if(!is_array($option)){
          
            $this->error= \Api\Controller\baseController::Invalid_Arguments;//参数错误
            return false;    //参数错误
        }
        
        //$option['medium_id'];媒介id 电影的id，文章的id，图书的id等等 option['types'] //类型 1.电影 2.读书 3.电视 4.音乐 5.广播
        if(empty($option['medium_id']) || empty($option['types'])){
           $this->error= \Api\Controller\baseController::Invalid_Arguments;//参数错误
            return false;    //缺少必要参数
        }


        if(empty($option['page'])){
            $option['page']=1;

        }
        //条件 媒介ID
        $comment_map['a.belong_id']=$option['medium_id'];
//    $comment_map['a.types']    类型 1.电影 2.读书 3.电视 4.音乐 5.广播
        $comment_map['a.types']=$option['types'];

        //计算总数量
        $count=M('link_comment a')
            ->join('db_user u ON a.user_id=u.id','left')
            ->join('db_comment b ON a.comment_id=b.id','left')
            ->join('db_comment bb ON b.pid=bb.id','left')
            ->join('db_user uu ON bb.user_id=uu.id','left')
            ->where($comment_map)
            ->count();
        $all_page=ceil($count/$option['page_size']);    //总页数
        $all_num=$count; //总条数
        //查询分页列表
        $list=M('link_comment a')
            ->join('db_user u ON a.user_id=u.id','left')    //查询评论人信息
            ->join('db_comment b ON a.comment_id=b.id','left')  //查询具体评论的内容
            ->join('db_comment bb ON b.pid=bb.id','left')       //查询该条评论是回复哪一条评论的评论内容
            ->join('db_user uu ON bb.user_id=uu.id','left')     //查询该条评论是回复那一条评论的评论人姓名
            ->where($comment_map)
            ->field($field)
            ->page($option['page'],$option['page_size'])
            ->select();
        //如果本条是直接对媒体的评论，那么这条将没有pid，所以一下四个参数会出现空值null，而不会出现设置的默认值空字符串，需要判断
        foreach ($list as $k=>$v){
            $list[$k]['upper_level_content']= $list[$k]['upper_level_content']? $list[$k]['upper_level_content']:'';
            $list[$k]['upper_level_id']= $list[$k]['upper_level_id']? $list[$k]['upper_level_id']:'';
            $list[$k]['upper_level_user_id']= $list[$k]['upper_level_id']? $list[$k]['upper_level_user_id']:'';
            $list[$k]['upper_level_user_name']= $list[$k]['upper_level_user_name']? $list[$k]['upper_level_user_name']:'';
        }
        if(!empty($list)){
            //组合好返回的数据
            $arr=Array(
                'curr_page'=>(int)$option['page'],//当前页码
                'all_page'=>$all_page,            //总页数
                'all_page_num'=>(int)$all_num,         //总条数
                'list'=>$list,                    //分页后的列表
            );

            return $arr;
        }else{
            $this->error=\Api\Controller\baseController::NOT_EXISTS;//参数错误
            return false;
        }

    }

}