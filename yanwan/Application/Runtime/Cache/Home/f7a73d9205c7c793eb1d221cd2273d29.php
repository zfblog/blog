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
<link rel="stylesheet" type="text/css" href="/yanwan/Public/css/scss.css">
<body>
<div class="header">
    <a href=""><img src="/yanwan/Public/img/backicon.png"/></a>
    <p >用户情况</p>
</div>
<form action="/yanwan/index.php/Home/Userinfo/projecttype?YW_Staff_ID={$id}" method="post" onSubmit="return shijian()" >  <!--/yanwan/index.php/Home/Userinfo/skintype?YW_User_ID={$id}-->
<div class="content">
    <input style="display:none;"  name="YW_Staff_Goods_Project" value="{$values['yw_project_id']}" />
    <?php if(is_array($userinfo)): foreach($userinfo as $num=>$valuef): ?><div>
            <p class="type_title">{$num}</p>
        <div class="skin_module" >
            <?php if(is_array($valuef)): foreach($valuef as $pro_id=>$values): if($pro_id%3==2 ): ?><label style="margin-right:0px;"  for="pro{$values['yw_project_id']}">
                     <input style="display:none;"   type="checkbox" id="pro{$values['yw_project_id']}" value="{$values['yw_project_id']}" class="project_choose"   />
                     <span>{$values['yw_project_name']}</span>
                     </label> 
                 <?php else: ?>
                     <label style=""  for="pro{$values['yw_project_id']}">
                     <input style="display:none;"   type="checkbox" id="pro{$values['yw_project_id']}" value="{$values['yw_project_id']}" class="project_choose"  />
                     <span>{$values['yw_project_name']}</span>
                     </label><?php endif; endforeach; endif; ?>
         </div>
         </div><?php endforeach; endif; ?>
</div><!--content-->

<div class="footer" ><input type="submit" value="提交"/></div>
</form > 
<script>

var input=document.getElementsByTagName("input");
//   
   for(i=0;i<input.length;i++){
	   input[i].onchange=function(){
		   if(this.checked==true){
			   this.parentNode.style.background="url(/yanwan/Public/img/okicon.jpg) no-repeat"
			   this.parentNode.style.color="#009e96";
			   this.parentNode.style['background-position']='left';
			}else{
				this.parentNode.style.color="#666666";
				this.parentNode.style.background="url(/yanwan/Public/img/moren.png) no-repeat"
				this.parentNode.style['background-position']='left';
			}
			
	       }  
	 }
     function shijian(){
		     var str="";
		     for(i=0;i<input.length;i++){
   			    if(input[i].checked==true){
				   str+=input[i].value+",";
				}
             }
			console.log(str);
		    document.getElementsByName("YW_Staff_Goods_Project")[0].value=str;
			console.log( document.getElementsByName("YW_Staff_Goods_Project")[0].value);
		
		 return   true;
         
	  }

</script>
</body>
</html>