<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<script language="javascript" src="../js/jquery-2.2.4.min.js"></script>
</head>

<body>
<button id="sb">点击</button>

<script type="text/javascript">  
$(function(){  
$.ajax(  
  {  
       type:'get',  
      // url : '/php/thinkphp/index.php/Home/Index/ajaxone?loginuser=122&loginpass=123',  当前控制器
	   url : 'http://127.0.0.1/php/thinkphp/index.php/Home/index/test?loginuser=122&loginpass=123', //当前方法
       dataType : 'jsonp',  
       jsonp:"jsoncallback",  
        success  : function(data) {  
           alert("用户名："+ data.user +" 密码："+ data.pass);  
       },  
        error : function() {
			 
           alert('fail');  
       }  
    }  
);  
})  
</script>  

</body>
</html>