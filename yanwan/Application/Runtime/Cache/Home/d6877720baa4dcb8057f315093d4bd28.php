<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="/php/thinkphp/index.php/Home/Public/css/css.css" />
		<!--<script src="js/bootstrap.min.js"></script>-->
		<title></title>
		<style>
		.main_container{
			width:1200px;
			margin:0 auto;
	/*		background:red;*/
		}
		.crumb_nav{
			margin-top:48px;
			height:40px;
			font:14px "微软雅黑";
		 }
		.crumb_nav span{
			line-height:34px;
			float:left;
		}
		.placeul li{
			float:left;
		    line-height:34px;
		    padding-left:2px;
		}
	    a{
			text-decoration:none;
			color:#666666;
		}
		.book_details{
			overflow:hidden;
			background:#ffffff;
		}
		#first a{
			color:#4e7a63;
 		}
		.book_pic{
			float:left;
			width:108px;
			border-right:2px solid #f0f0f0;
			padding:23px 80px 40px 73px;
		}
		.book_intro{
			float:left;
		}
		.book_pic img{
			box-shadow:3px 9px 20px #aaaaaa;
		}
		.book_abstract{
			overflow:hidden;
			padding:20px 0 20px 32px;
			border-bottom:2px  solid #f0f0f0;
		}
		.book_title{
			float:left;
		}
		.book_title p{
			font:20px "微软雅黑";
		}
		.book_title span{
			font:12px "微软雅黑";
		}
		.book_score{
			float:left;
			margin-left:368px;
		}
		 .book_score div{
		    float:left;
	   }
	   .book_score p{
		   text-align:right;
		   font:12px "微软雅黑"; 
	   }
		.star{
		   margin:6px 0px 4px 0px;
	   }
	   .score{
		   font:34px "微软雅黑";
		   margin:0px 49px 0px 18px;
	   }
	  .book_operate{
		  font:12px "微软雅黑";
		  color:#666666;
		  padding:30px 0px 20px 34px ;
	  }
	  .price span:last-child{
		  text-decoration: line-through;
		  margin-left:26px;
	  }
	  .operate_button button{
		  font:14px "微软雅黑";
		  height :30px;
		  width:92px;
		  border-radius:8px;
		  margin:18px 10px 0px 0px;
	  }
	  .bookcase{
		  background:#4e7a63;
		  color:#ffffff;
	  }
	  .shopping{
		  background:#e7f3f0;
		  color:#4e7a63;
	  }		
	  .book_content{
		  background:#ffffff;
		  margin-top:40px;
		  padding-bottom:40px;
	  } 
	  .preface_text{
		  width:1048px;
		  height:1350px;
		  margin:0 auto;
		  font:20px "微软雅黑";
	  }  
	  .preface_text p{
		  line-height:50px;
		  text-indent:2em;
	  }  
	  .preface{
		  margin:0px 20px 20px;;
		  padding:106px 0px 12px 0px;;
		  text-align:center;
		  border-bottom:1px solid #f0f0f0;
		  font: 24px  "微软雅黑" ;
		  color:#4e7a63;
	  }	
	  .book_page{
		  text-align:center;
	  }
	  .book_page a{
		  border:1px solid #b5b5b5;
		  background:#f4f4f4;
		  font_size:16px;
		  padding:6px 10px 6px 10px;
	  }
	  .footer{
		  margin-top:80px;
	  }

	  
	  
</style>
	</head>
	<body>
		<div id="TOP">
            <div id="public_Navigation">

		<div class="top_ul">
			<div id="public_Navigation_loog">
		從&nbsp;心
			</div>	
				<ul class="top_li">
					<li class="top_li_one"><a href="">首页 HOME</a></li>
					<li class="top_li_two"><a href="#">咨询 CONSULT</a></li>
					<li class="top_li_three"><a href="#">减压 DECOMPRESSION</a></li>
					<li class="top_li_four"><a href="#">分享 SHARE</a></li>
					<li class="top_li_five"><a href="#">HI,Jenny</a></li>
				</ul>
			</div>
		</div>
            <div class="main_container">
                <div class="crumb_nav">
                    <span>当前坐标：</span>
                    <ul class="placeul">
                    <li id="first"><a href="#">书店首页&gt</a></li>
                    <li><a href="#">励志类&gt </a></li>
                    <li><a href="#">少有人走的路&gt </a></li>
                    <li><a href="#">免费试读</a></li>
                    </ul>
                </div>
                
                <div class="book_details">
                    <div class="book_pic">
                        <img src="img/bookcover1.jpg" />
                    </div>
                    <div class="book_intro">
                         <div class="book_abstract">
                             <div class="book_title">
                                 <p>《你配得上更好的人生》</p>
                                 <p><span>&nbsp;&nbsp;&nbsp;作者：</span><span>沈嘉柯&nbsp;&nbsp;&nbsp;&nbsp;</span><span>页数：</span><span>272&nbsp;&nbsp;&nbsp;&nbsp;</span><span>出版社：</span><span>江苏凤凰文艺出版社</span></p>
                             </div>
                             <div class="book_score">
                                 <div class="star">
                                 <img src="img/starg.jpg" />
                                 <img src="img/starg.jpg" />
                                 <img src="img/starg.jpg" />
                                 <img src="img/starg.jpg" />
                                 <img src="img/starw.jpg" />
                                 <p >232人评分</p>
                                 </div>
                                 <div class="score">
                                 8.9
                                 </div>
                             </div>
                         </div>
                         <div class="book_operate">
                             <div class="price">
                                 <span>价格：12.99元</span> 
                                 <span>原价：26.00元</span>
                             </div>
                             <div class="operate_button">
                                 <button class="bookcase">加入书柜</button>
                                 <button class="shopping">立即购买</button>
                             </div>
                         </div>
                    </div>
                </div>
                
                
                <div class="book_content">
                    <div class="preface">序&nbsp;言</div>
                    <div class="preface_text">   
                        <p>如果把时光倒推回去，16岁那年的我，遇到今时今日的我，应该会觉得非常陌生。那个孤傲内向的少年，想象不到未来要经历多少的挫败，消化多少痛苦，然后在浩瀚的世界上，学会温柔，变得聪明，掌握力量。</p>
                        <p>我在学生时代，就以散文随笔、杂文评论，登上了中国几乎所有的大报名刊。后来我发现，凭借这些稿费收入，我养活了自己，还能给家里父母钱，我觉得很快乐，也很有成就感。那时候，我才十八九岁。这种感觉，我非常享受。
                        别人玩耍的时候，我在稿纸上窸窸窣窣地奋笔疾书。我用稿费给自己买了电脑，从此进入了写作这个古老的行业。</p>
                        <p>曾有过漫长的低潮沉默。有一天，我独自坐在台阶上，看着深夜的月亮，悲伤良久。我接受自己的沮丧哀伤，也会珍藏这种哀伤。当我从中走出来的时候，我情愿自己成为做事勇猛、内心平和的人。
                        年少的我不知道自己会走到什么样的境地，我只是模模糊糊地觉得，我愿意为自己想要的东西，付出努力去得到，拥有更好的人生。</p>
                        <p>甚至这个“更好的人生”，也不再由别人来定义，而是我自己说了算。</p>
                        <p>我想要热血沸腾，热泪盈眶的时候，我就去做这样的事情。哪怕昏天黑地每天工作十六个小时累得像条狗。</p>
                        <p>我想要内心安定，我也有资本回到自己一个人的王国当中。写不需要任何人赞美的诗，视功名为粪土。</p>
                        <p>我们三个成长于不同年代的人（70、80、90），我们的故事，当你读到了，也就属于你了。</p>
                        <p>你对自己那么凶狠，世界才对你稍露温柔。这看起来很不公平，但也无所谓。你踏遍山河，一路修行，成为强大的人，从此自己对自己温柔。</p>
                        <p>不管你从哪里出发，都得出发。就像所有的河流都流向海。你配得上更好的人生。</p>
                        <p></p>
                    </div>
                    <div class="book_page">
                        <a href="#">&lt 上一页</a>
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">下一页&gt </a>
                    </div>
                </div>
            </div>
            <div class="footer">页尾</div>
        
        
        
        </div>
	</body>
</html>