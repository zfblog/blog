<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" type="text/css" href="/yanwan/Public/css/xfgr.css"/>
		<link rel="stylesheet" type="text/css" href="/yanwan/Public/css/xfgr1.css"/>
		<script src="/yanwan/Public/js/jquery-2.2.4.min.js" ></script>
	</head>
	<body>
		<div class="xf">
		<div class="xf1">
			<div class="xf2">
				<a href="#"><</a></div>
			<div class="xf3" align="center">个人绩效</div>
			<div style="clear:both"></div>
		</div>
		<div class="xf4">
			<div class="xf5">本月共完成<a href="#"><?php echo ($staff_performance_count); ?></a>单</div>
		</div>
			<?php if(is_array($staff_performance_arr)): foreach($staff_performance_arr as $key=>$value): ?><div class="xf6">
					<div class="xf7"><img src="../img/<?php echo ($staff_performance_arr[$key]['project_arr'][0]['yw_project_img']); ?>"/></div>
					<div class="xf8"><?php echo ($staff_performance_arr[$key]["project_arr"][0]["yw_project_name"]); ?></div>
					<div class="xf9"><a href="#"><?php echo ($staff_performance_arr[$key]["project_arr"][0]["yw_project_cost_money"]); ?></a>元/1人</div>
					<div class="xf10"><?php echo ($staff_performance_arr[$key]["yw_count_number"]); ?>单</div>
				</div><?php endforeach; endif; ?>
			<br />
			<br />
		</div>
	</body>
</html>