- 本项目中使用**Api模块作为接口目录、默认模块**，即开发都在此模块下  
- 已进行Url优化，隐藏index.php    
如：douban/index.php/movie/Top250  现在可直接使用douban/movie/Top250访问
- 控制器须继承baseController.class.php 
- 接口响应返回格式统一使用JSON，在公共函数success()、error()中已实现JSON格式转换，因此调用前无需再对数据进行格式化

  
  
  ## 数据返回
  -  数据返回使用公共函数success()、error()。其中**错误返回必须设置错误码**，错误码的解释以及解决办法需在接口文档中根据业务逻辑做出相关说明
   
  
  ## 业务错误码列表
统一在Application/Api/Controller/baseController.class.php中以对象的静态属性的格式进行设置，调用时以访问静态属性的方式使用。如用户未传必要参数，这时候的错误码为：baseController::Miss_Arguments

错误码  | 错误描述 | 解决方案
---|---|--
12 | 缺少必要参数 | 传入参数
13 | 参数无效|一般是用户传入参数非法引起，请仔细检查入参格式、范围是否一一对应
14|查询不到数据|
25|权限不足、非法访问|
97|不存在的控制器|使用的控制器必须是确实存在的
98|不存在的方法名|传入的method字段必需是你所调用的API的名称，并且该API是确实存在的



 

  