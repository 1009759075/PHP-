<?php
return array(
	/* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     		// 数据库类型
    'DB_HOST'               =>  'www.arjianyu.cn',  // 服务器地址
    'DB_NAME'               =>  'douban',           // 数据库名
    'DB_USER'               =>  'db',      	        // 用户名
    'DB_PWD'                =>  'dbapi123',        // 密码
    'DB_PORT'               =>  '3306',        		// 端口
    'DB_PREFIX'             =>  'db_',    			// 数据库表前缀
    
    'MODULE_ALLOW_LIST' => array('Api'),//可访问模块
//    'MULTI_MODULE'          =>  false,  // 关闭多模块访问
    'DEFAULT_MODULE'        =>  'Api',  //  默认模块

    'LIMIT_PROXY_VISIT' => false
);