<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/5/12
 * Time: 12:40
 */
namespace Api\Model;
use Think\Model;
class CommentModel extends BaseModel{


    //获取一级评论
    public function get_level1_comment($option){
        $field='b.id,b.content,b.star,b.like,bb.content upper_level_content,bb.id upper_level_id,u.name user_name,u.id user_id,uu.name upper_level_user_name,uu.id upper_level_user_id';
        //参数必须是数组
        if(!is_array($option)){
            $res=$this->Model_error_return(1001,'',self::OPTION_ERROR);
            return $res;
        }
        
        //$option['medium_id'];媒介id 电影的id，文章的id，图书的id等等
        if(empty($option['medium_id'])){
            $res=$this->Model_error_return(1002,'','需要的medium_id为空');
            return $res;
        }
        if(empty($option['types'])){
            $res=$this->Model_error_return(1002,'','需要的types为空');
            return $res;
        }

        if(empty($option['page'])){
            $option['page']=1;
        }
        //条件 媒介ID
        $comment_map['a.belong_id']=$option['medium_id'];
//    $comment_map['a.types']    类型 1.电影 2.读书 3.电视 4.音乐 5.广播
        $comment_map['a.types']=$option['types'];
       // $comment_map['b.pid']=0;//表示这是一级评论
        $count=M('link_comment a')
            ->join('db_user u ON a.user_id=u.id','left')
            ->join('db_comment b ON a.comment_id=b.id','left')
            ->join('db_comment bb ON b.pid=bb.id','left')
            ->join('db_user uu ON bb.user_id=uu.id','left')
            ->where($comment_map)
            ->count();
        $all_page=ceil($count/self::PAGESIZE);
        $all_num=$count;
        $list=M('link_comment a')
            ->join('db_user u ON a.user_id=u.id','left')
            ->join('db_comment b ON a.comment_id=b.id','left')
            ->join('db_comment bb ON b.pid=bb.id','left')
            ->join('db_user uu ON bb.user_id=uu.id','left')
            ->where($comment_map)
            ->field($field)
            ->page($option['page'],self::PAGESIZE)
            ->select();
        foreach ($list as $k=>$v){
            $list[$k]['upper_level_content']= $list[$k]['upper_level_content']? $list[$k]['upper_level_content']:'';
            $list[$k]['upper_level_id']= $list[$k]['upper_level_id']? $list[$k]['upper_level_id']:'';
            $list[$k]['upper_level_id']= $list[$k]['upper_level_id']? $list[$k]['upper_level_id']:'';
            $list[$k]['upper_level_user_id']= $list[$k]['upper_level_id']? $list[$k]['upper_level_user_id']:'';
            $list[$k]['upper_level_user_name']= $list[$k]['upper_level_user_name']? $list[$k]['upper_level_user_name']:'';
        }
        $arr=Array(
            'curr_page'=>(int)$option['page'],
            'all_page'=>$all_page,
            'all_num'=>(int)$all_num,
            'list'=>$list,
        );

        $res=$this->Model_success_return(1,$arr,'');
        return $res;
    }

}