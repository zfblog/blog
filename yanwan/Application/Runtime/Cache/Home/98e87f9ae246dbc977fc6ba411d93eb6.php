<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
		123456
		<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><ul>
				<li>{$vo[0].yw_project_id}</li>
				<li>{$vo[0].yw_project_name}</li>
				<li>{$vo[0].yw_project_efficacy}</li>
				<li>{$vo[0].yw_project_cost_money}</li>
				<li>{$vo[0].yw_project_cost_integral}</li>
				<li>{$vo[0].yw_largeclass_id}</li>
				<li>{$vo[0].yw_project_img}</li>
			</ul><?php endforeach; endif; else: echo "" ;endif; ?>
	</body>
</html>