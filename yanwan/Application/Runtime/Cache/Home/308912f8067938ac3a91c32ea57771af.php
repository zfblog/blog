<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="/yanwan/Public/css/yys.css"/>
		<link rel="stylesheet" type="text/css" href="/yanwan/Public/css/yw_staff_select.css"/>
		<script type="text/javascript" src="/yanwan/Public/js/yw_login.js"></script>
		<script type="text/javascript" src="/yanwan/Public/js/jquery-2.2.4.min.js"></script>
	</head>
	<body>
		<div data-role = "page" id="page1">
			<div data-role="header" id="header">
				<div class="status_bar"></div>
				<div class="navigation_bar">
					<div class="navigation_a">
						<a data-rel = "back" onClick="javascript :history.go(-1);">
							<div class="navigation_a_img"></div>
						</a>
					</div>
					<div class="navigation_txt">
						<?php if(($code == 1005)): elseif(($code == 1004)): ?>
				   			<?php else: ?>
				   			<?php if(($managementarr[0]['yw_user_rank'] == 2)): ?>店长管理
					   			<?php elseif(($managementarr[0]['yw_user_rank'] == 3)): ?>美容顾问管理
					   			<?php else: endif; endif; ?>
					</div>
				</div>
			</div>
			<div data-role = "content" id="content">
					 <?php if(is_array($managementarr)): foreach($managementarr as $k=>$vo): ?><div class="information">
							<div class="information_left">
								<div class="information_img">
									<img src="/yanwan/Uploads/headerpic/small/{$managementarr[$k]['yw_staff_headpic']}" />
								</div>
								<div class="information_txt">{$managementarr[$k]["yw_staff_name"]}</div>
							</div>
							<div class="information_middle">
								<div class="information_phone">{$managementarr[$k]["yw_user_phone"]}</div>
								<div class="information_sex">{$managementarr[$k]["yw_staff_sex"]}</div>
								<div class="information_account_number">{$managementarr[$k]["yw_user_name"]}</div>
							</div>
								<div class="information_right" onclick="staff_delete({$managementarr[$k]['yw_user_id']})">
									<div class="information_right_img"></div>
								</div>
						
						</div><?php endforeach; endif; ?>
	   				<?php if(is_array($managementarr)): foreach($managementarr as $k=>$vo): ?><div class="information">
							<div class="information_left">
								<div class="information_img">
									<img src="/yanwan/Uploads/headerpic/small/{$managementarr[$k]['yw_staff_headpic']}" />
								</div>
								<div class="information_txt">{$managementarr[$k]["yw_staff_name"]}</div>
							</div>
							<div class="information_middle">
								<div class="information_phone">{$managementarr[$k]["yw_user_phone"]}</div>
								<div class="information_sex">{$managementarr[$k]["yw_staff_sex"]}</div>
								<div class="information_account_number">{$managementarr[$k]["yw_user_name"]}</div>
							</div>
								<div class="information_right" onclick="staff_delete({$managementarr[$k]['yw_user_id']})">
									<div class="information_right_img"></div>
								</div>
						
						</div><?php endforeach; endif; ?>
	   				<div class="coutent_bottom">
	   				</div>
			</div>
			
			<div data-role = "footer" id="footer">
				<a href="/yanwan/index.php/Home/Staffmanagement/staff_value?YW_User_Rank={$YW_User_Rank}" class="footer_a">
					<?php if(($YW_User_Rank == 1)): ?>添加新店长
					   <?php elseif(($YW_User_Rank == 2)): ?>添加新美容顾问
					   	<?php else: endif; ?>	
				</a>
			</div>
			<div id="land_display">
				<div class="land_display_div">
					<div class="land_display_text">确定要删除他/她？</div>
					<a id="land_display_flase_a"><div class="land_display_flase">否</div></a>
					<a href="#" id="land_display_ture_a"><div class="land_display_ture">是</div></a>
				</div>
			</div>
			<div id="display1">
				<a href="/yanwan/index.php/Home/Staffmanagement/staff_select?YW_User_Rank={$YW_User_Rank}">
					<div class="display1_div">
						<div class="display1_text">删除成功</div>
						     <div class="display1_img"></div>
					</div>
				</a>
	  		</div>
			<div id="display2">
				<a href="/yanwan/index.php/Home/Staffmanagement/staff_select?YW_User_Rank={$YW_User_Rank}">
					<div class="display2_div">
						<div class="display2_text">删除失败</div>
							<div class="display2_img"></div>
					</div>
				</a>
			</div>
		</div>
		<?php if(($code == 1000)): ?><script type="text/javascript">document.getElementById("display1").style.display="block";</script>
			<?php elseif(($code_select == 1001)): ?><script type="text/javascript">document.getElementById("display2").style.display="block";</script>
			<?php else: endif; ?>
	</body>
	<script type="text/javascript">
		function staff_delete(yw_user_id){
			$(function(){
				document.getElementById("land_display").style.display="block";
				$("#land_display_ture_a").attr("href","/yanwan/index.php/Home/Staffmanagement/staff_delete?YW_User_ID="+yw_user_id)
			})
		}
		$(function(){
			$("#land_display_flase_a").click(function(){
				document.getElementById("land_display").style.display="none";
			})
		})
	</script>
</html>