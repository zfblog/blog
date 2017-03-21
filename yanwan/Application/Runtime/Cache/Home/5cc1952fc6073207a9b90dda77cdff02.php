<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="/yanwan/Public/css/xfjl.css"/>
		<link rel="stylesheet" type="text/css" href="/yanwan/Public/css/xfjl1.css"/>
		<script src="/yanwan/Public/js/jquery-2.2.4.min.js" ></script>
		<title></title>
	</head>
	<body>
		<div class="xf">
		<div class="xf1">
			<div class="xf2"><a href="#"><</a></div>
			<div class="xf3" align="center">消费记录</div>
			<div style="clear:both"></div>
		</div>
		<div class="xf4">
			<div class="xf5"><a href="#"><img src="/yanwan/Uploads/img/"+<?php echo ($user_arr[0]['yw_user_headpic']); ?>/></a></div>
			<div class="xf6"><?php echo ($user_arr[0]["yw_user_name"]); ?></div>
			<div class="xf7">干性皮肤</div>
		</div>
		<div class="xf8">
			<div class="xf8a">项目</div>
			<div class="xf8b">金额</div>
			<div class="xf8c">时间</div>
		</div>
		<?php if(is_array($user_consume_arr)): foreach($user_consume_arr as $key=>$value): ?><div class="xf9">
				<div class="xf9a"><?php echo ($project_arr[$key][0]["yw_project_name"]); ?></div>
				<div class="xf9b"><li><?php echo ($project_arr[$key][0]["yw_project_cost_money"]); ?></li>/元</div>
				<div class="xf9c"><?php echo ($user_consume_arr[$key]["yw_userconsume_time"]); ?></div>
			</div><?php endforeach; endif; ?>
		<br />
		<br />
		<br />
		<br />
		<div class="xf12"><input type="button" class="xf12a" value="添加新消费记录" /></div>
		</div>
	</body>
</html>