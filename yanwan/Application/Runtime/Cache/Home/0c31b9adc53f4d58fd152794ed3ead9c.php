<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />

    <link rel="stylesheet" type="text/css" href="/yanwan/index.php/Home/Public/css/css.css" />
		<!--<script src="js/bootstrap.min.js"></script>-->
		<title></title>

	</head>
	<body>
                <div class="book_content">
                    <div class="preface">upadat</div>
     
                </div>
                <form action="/yanwan/index.php/Home/Userinfo/userinfoupdata?YW_User_ID=1&tablename=yw_user_info"  method="post" enctype="multipart/form-data">
                  <input type="file" name="YW_User_HeadPic"
                  <input name="YW_User_Address"/>
                  <input name="YW_User_Sex"/>
                  <input type="submit" value="提交" />
                </form>
                
      
   
        

	</body>
</html>