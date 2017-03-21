<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
</head>
<style>
*{margin:0px;font-family:"微软雅黑";}
.header{background:#009e96;line-height:100px; overflow:hidden;width:100%;}
.header p{float:right;margin-right:45%;solid;font-size:1.5rem;color:#ffffff; }
.header a{display:block;float:left;width:0.85rem;margin-left:4%;}
label{
	display:block;
	float:left;
	width:28%;
	font-size:1.25rem;
    background:url(/yanwan/Public/img/moren.png) no-repeat; 
	background-position:center left;
	color:#666666;
/*	
	background:red;*/
	vertical-align:central;
	margin:34px 7.5% 23px 0px;
}
label span{
	margin-left:20%;
}
.content{
	background:#fafafa;
	padding:0px 4%;
}
.content>div{
	padding-top:40px;
}
.skin_module{
	background:#ffffff;
	overflow:hidden;
}
.margin_last{
	margin-right:0px;
	}
.type_title{
	font-size:1.3rem;
	padding-bottom:16px;
	color:#333333;
}
/*.footer{
	background:#009e96;
	line-height:110px;
	text-align:center;
	font-size:1.4rem;
	color:white;
}*/
.footer input{
	border:0px;
	width:100%;
	display:block;
	background:#009e96;
	line-height:110px;
	text-align:center;
	font-size:1.4rem;
	color:white;
}
.need_input{
    display:none;
}

</style>
<link rel="stylesheet" type="text/css" href="/yanwan/Public/css/changecss.css">
<body>
<div class="header">
    <a href=""><img src="/yanwan/Public/img/backicon.png"/></a>
    <p >用户情况</p>
</div>
<form action="/yanwan/index.php/Home/Userinfo/skintype?YW_User_ID=<?php echo ($id); ?>" method="post" onSubmit="return shijian()" >  <!--/yanwan/index.php/Home/Userinfo/skintype?YW_User_ID={$id}-->
<div class="content">

    <?php if(is_array($userinfo)): foreach($userinfo as $num=>$valuef): ?><div>
            <?php switch($num): case "yw_user_skin_type": ?><p class="type_title">皮肤类型检测</p> <input  name='YW_User_Skin_Type'   class="need_input" value="" /><?php break;?>
                <?php case "yw_user_skin_condition": ?><p class="type_title">皮肤状况</p> <input  name='YW_User_Skin_Condition'   class="need_input" value="" /><?php break;?>
                <?php case "yw_user_nose_condition": ?><p class="type_title">鼻子状况</p> <input  name='YW_User_Nose_Condition'   class="need_input" value="" /><?php break;?>
                <?php case "yw_user_neck_condition": ?><p class="type_title">颈部状况</p> <input  name='YW_User_Neck_Condition'   class="need_input" value="" /><?php break;?>
                <?php case "yw_user_chin_condition": ?><p class="type_title">下巴状况</p> <input  name='YW_User_Chin_Condition'   class="need_input" value="" /><?php break;?>
                <?php case "yw_user_eye_condition": ?><p class="type_title">眼部状况 </p><input  name='YW_User_Eye_Condition'  class="need_input" value="" /><?php break; endswitch;?>
        
        <div class="skin_module" >
            <?php if(is_array($valuef)): foreach($valuef as $order_id=>$values): if($order_id%3==2 ): ?><label style="margin-right:0px;"  for="<?php echo ($num); echo ($order_id); ?>">
                     <input style="display:none;"   type="checkbox" id="<?php echo ($num); echo ($order_id); ?>" value="1" class="<?php echo ($num); ?>"  />
                     <span><?php echo ($values); ?></span>
                     </label> 
                 <?php else: ?>
                     <label style=""  for="<?php echo ($num); echo ($order_id); ?>">
                     <input style="display:none;"   type="checkbox" id="<?php echo ($num); echo ($order_id); ?>" value="1" class="<?php echo ($num); ?>"  />
                     <span><?php echo ($values); ?></span>
                     </label><?php endif; endforeach; endif; ?>
         </div>
         </div><?php endforeach; endif; ?>
</div><!--content-->
<p id='abc'></p>
<div class="footer" ><input type="submit" value="提交"/></div>
</form > 
<script>

var inputl=document.getElementsByTagName("input");
//   
   for(i=0;i<inputl.length;i++){
	   inputl[i].onchange=function(){
		   if(this.checked==true){
			   this.value=1
			   this.parentNode.style.background="url(/yanwan/Public/img/okicon.jpg) no-repeat"
			   this.parentNode.style.color="#009e96";
			   this.parentNode.style['background-position']='left';
			}else{
				this.value=0
				this.parentNode.style.color="#666666";
				this.parentNode.style.background="url(/yanwan/Public/img/moren.png) no-repeat"
				this.parentNode.style['background-position']='left';
			}
			
	       }  
	 }
     function shijian(){
		 var filed=['yw_user_skin_type','yw_user_skin_condition','yw_user_nose_condition','yw_user_neck_condition','yw_user_chin_condition','yw_user_eye_condition']
		 var filedl=['YW_User_Skin_Type','YW_User_Skin_Condition','YW_User_Nose_Condition','YW_User_Neck_Condition','YW_User_Chin_Condition','YW_User_Eye_Condition']
		 for(j=0;j<filed.length;j++){
		     var input=document.getElementsByClassName(filed[j])
		     var str="";
		     for(i=0;i<input.length;i++){
   			    if(input[i].checked==true){
					alert(1)
				   str+="1,"
				}else{
					alert(2)
					str+="0,"
				}
             }
			console.log(str);
			console.log( filedl[j]);
		    document.getElementsByName(filedl[j])[0].value=str;
			console.log( document.getElementsByName(filedl[j])[0].value);
		 }
		 return  true;
         
	  }
 
</script>
</body>
</html>