<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<link rel="stylesheet" type="text/css" href="/yanwan/Public/css/xfjlsy.css"/>
	<link rel="stylesheet" type="text/css" href="/yanwan/Public/css/xfjlsy1.css"/>
	<script src="/yanwan/Public/js/jquery-2.2.4.min.js" ></script>
	<body>
		<div class="xf">
			<div class="xf1">
				<div class="xf2"><a href="#"><</a></div>
				<div class="xf3" align="center">员工业绩</div>
				<div style="clear:both"></div>
			</div>
			<?php if(is_array($time)): foreach($time as $key=>$value): ?><div>
						<div class="xf4 today"  style="background-color: #DCDCDC;"><?php echo ($time[$key]); ?></div>
						<?php if(is_array($message)): foreach($message as $vkey=>$vvalue): if(($message[$vkey]['yw_userConsume_time'][0] == $time[$key])): ?><div class="xf5">
									<div class="xf5a"><?php echo ($message[$vkey]["yw_staff_name"]); ?></div>
						            <div class="xf6">
						            	<div class="xf6a">项目:</div>
						            	<div class="xf6b"><?php echo ($message[$vkey]["yw_project_name"]); ?></div>
						            	
						            	<div class="xf6d"><?php echo ($message[$vkey]["yw_userConsume_time"][1]); ?></div>
						            </div>
						        </div>
							</else><?php endif; endforeach; endif; ?>
					</div><?php endforeach; endif; ?>
		</div>
			
	</body>
	
	<script type="text/javascript">
			$(document).ready(function(){
				var mydate = new Date();
				var month = mydate.getMonth()+1;
				if(month < 10){
					month = "0"+ month;
				}
				var day_1 = mydate.getDate();
				var time = mydate.getFullYear()+"-"+month+"-"+day_1;
				var div_len = $(".today").length;
				for(var i = 0; i< div_len; i++){
					var today = $(".today").eq(i).html();
					if(time == today){
						$(".today").eq(i).html("今天");
					}
				}
				
				for(var i = 0; i< div_len; i++){
					var today = $(".today").eq(i).html();
					day_1 = mydate.getDate()-1;
					var time = mydate.getFullYear()+"-"+month+"-"+day_1;
					if(time == today){
						$(".today").eq(i).html("昨天");
					}
				}
				
				for(var i = 0; i< div_len; i++){
				
				}
				
				

			});
	</script>
</html>