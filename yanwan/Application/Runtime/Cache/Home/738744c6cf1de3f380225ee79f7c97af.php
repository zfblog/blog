<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<script src="/yanwan/Public/js/jquery-2.2.4.min.js" ></script>
	<body>
		<?php if(is_array($time)): foreach($time as $key=>$value): ?><div>
					<div class="today"><?php echo ($time[$key]); ?></div>
					<br />
					<?php if(is_array($message)): foreach($message as $vkey=>$vvalue): if(($message[$vkey]['YW_UserConsume_Time'][0] == $time[$key])): ?><div>YW_Staff_Name:<?php echo ($message[$vkey]["YW_User_Name"]); ?></div>
							<div>YW_Project_Name:<?php echo ($message[$vkey]["YW_Project_Name"]); ?></div>
							<div>YW_Project_Name:<?php echo ($message[$vkey]["YW_Project_Cost_Money"]); ?></div>
							<div>YW_UserConsume_Time:<?php echo ($message[$vkey]["YW_UserConsume_Time"][1]); ?></div>
							
							<br />
						</else><?php endif; endforeach; endif; ?>
				</div><?php endforeach; endif; ?>
		
			
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