// JavaScript Document
function C(str){
	return document.getElementsByClassName(str);

}
function I(str){
	return document.getElementById(str);

}
function T(str){
	return document.getElementsByTagName(str);

}

C("shopping")[0].onclick=function(){
		/*body{ -webkit-filter: blur(2px);
 
-moz-filter: blur(2px);
 
-o-filter: blur(2px);
 
-ms-filter: blur(2px);
 
filter: blur(2px);}*/
       
		I("TOP").style.filter="blur(2px)";
	//	I("TOP").style.\-moz\-filter="blur(2px)";
//		I("TOP").style.-o-filter="blur(2px)";
//		I("TOP").style.-ms-filter="blur(2px)";
	    C("book_car")[0].style.display="block";
		 C("book_car")[0].style.filter="";
	}