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
        $field='b.id,b.content,b.star,b.like';
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
        if(empty($option['page'])){
            $option['page']=1;
        }
        //条件 媒介ID
        $comment_map['a.belong_id']=$option['medium_id'];
        $comment_map['b.pid']=0;//表示这是一级评论
        $count=M('link_comment a')
            ->join('db_comment b ON a.comment_id=b.id','left')
            ->where($comment_map)
            ->count();
        $all_page=ceil($count/self::PAGESIZE);
        $list=M('link_comment a')
            ->join('db_comment b ON a.comment_id=b.id','left')
            ->where($comment_map)
            ->field($field)
            ->page($option['page'],self::PAGESIZE)
            ->select();
        foreach ($list as $k=>$v){
            $list[$k]['add_time']=date('Y年m月d日',$v['add_time']);
        }
        $arr=Array(
            'curr_page'=>(int)$option['page'],
            'all_page'=>$all_page,
            'list'=>$list
        );

        $res=$this->Model_success_return(1,$arr,'');
        return $res;
    }

}