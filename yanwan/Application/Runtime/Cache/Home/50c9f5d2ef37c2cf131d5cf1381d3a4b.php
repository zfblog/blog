<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/yanwan/Public/css/yys.css"/>
		<link rel="stylesheet" type="text/css" href="/yanwan/Public/css/yw_login.css"/>
		<script type="text/javascript" src="/yanwan/Public/js/yw_login.js"></script>
		<script type="text/javascript" src="/yanwan/Public/js/jquery-2.2.4.min.js"></script>
	</head>
	<body>
		<div class="head_portrait"></div>
		<span id="massegin">
			<?php if(($code == 1000)): ?>{$userarr[0]['yw_user_rank']}
				<?php elseif(($code == 1005)): ?>
   				<?php else: ?>用户名或密码错误<?php endif; ?>
		</span>
		<div class="user_name">
			<div class="user_name_img"></div>
			<div class="user_name_text">账号</div>
			<div class="user_name_input">
				<input type="text" id="name_input"/>
			</div>
		</div>
		<div class="user_password">
			<div class="user_password_img"></div>
			<div class="user_password_text">密码</div>
			<div class="user_password_input" >
				<input type="password" id="password_input"/>
			</div>
		</div>
		<div class="login_button" onclick="login()">登陆</div>
		<div class="operation_password">
			<div class="forget_password">
				<a href="/yanwan/index.php/Home/Login/forget_password">忘记密码</a>
			</div>
			<div class="update_password">
				<a href="/yanwan/index.php/Home/Login/update_password">修改密码</a>
			</div>
		</div>
		
	</body>
	<script type="text/javascript">  
//	var num=Math.floor(Math.random()*10).toString()+Math.floor(Math.random()*10).toString();
//	alert(num);
//	 var timestamp = Date.parse(new Date());
//	alert(timestamp);
function login(){
	var user_name=$("#name_input").val();
	var user_password=$("#password_input").val();
	window.location.href="/yanwan/index.php/Home/Login/login?YW_User_Name="+user_name+'&YW_User_Password='+user_password; 
}
   
</script>  
	
	
</html>