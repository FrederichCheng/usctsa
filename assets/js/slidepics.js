/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
	$("#prv img").css({
		display:'none'
	});
	//設定縮圖的長度
	var total=$("#list ul li").length;
	//設定ul的寬度
	var ulWidth=total*61;
	$("#list ul").css("width",ulWidth);	
 
	//計算頁數
	var page=0;
	var maxpage=Math.floor(ulWidth/360);	
	$("#pagenum").html(page+"/"+maxpage);
 
//	$("#imgB").css("opacity", 0);
//	$("#imgB").fadeTo(1000, 1.0);
 
	var ImgObj=$("#list ul li img");
	ImgObj.click(function(){
                var num = $(this).attr("no");
		$("#imgB"+num).css("opacity", 0);
		var img=this.src.replace("images/s","images/b");
		$("#imgB"+num).attr("src",img);
 
		$("#imgB"+num).stop();
		$("#imgB"+num).fadeTo(1000, 1.0);
		//移除li上的on Class
		ImgObj.parents("li").removeClass("on");
		//將目前點到的加入on Class
		$(this).parents("li").addClass("on");	
 
		//關閉滑入縮圖
		ImgObj.mouseout();	
	});
 
//	ImgObj.mouseover(function(e){		
//		//取得滑鼠位置
//		var mousex=e.pageX;		
// 
//		//取出居中的數值
//		$("#overImg #Img").attr("src",img);
//		var _padding = parseInt($("#overImg").css("padding-left"))
//						+ parseInt($("#overImg").css("padding-right"));
//		var _border = parseInt($("#overImg").css("border-left-width"))
//							+ parseInt($("#overImg").css("border-right-width"));
//		var _l = $(this).offset().left - ($("#overImg").width()-_padding-_border) / 2;		
// 
//		//將圖片換成滑入的小圖
//		var img=this.src.replace("images/s","images/o");
// 
//		//overImg滑入圖片居中		
//		$("#overImg").css({
//			top:220,
//			left:_l,
//			display:'block'
//		});				
//		$("#overImg #Img").attr("src",img);		
//		$("#overImg").css("opacity", 0);
//		$("#overImg").stop();
//		$("#overImg").fadeTo(300, 1.0);	
//	});
// 
//	ImgObj.mouseout(function(){
//		$("#overImg").css({
//			top:-999999,
//			left:-999999,
//			display:'none'
//		});		
//	});
 
	//下一頁
	$("#next img").click(function(){
		if(page!=maxpage){
			page++;
			$("#prv img").css({
				display:'block'
			});
		}
		if(page == maxpage){
			$("#next").css({
				display:'none'
			});
		}
		//滾動縮圖
		$("#list ul").animate({left:-300*page},1000);
		$("#pagenum").html(page+"/"+maxpage);
	});
 
	//上一頁
	$("#prv img").click(function(){
		if(page >0){
			page--;
			$("#next").css({
				display:'block'
			});
		}	
		if(page ==0){
			$("#prv img").css({
				display:'none'
			});
		}
		//滾動縮圖
		$("#list ul").animate({left:-300*page},1000);
		$("#pagenum").html(page+"/"+maxpage);
	});
 
	//取消連結虛線框
	$("a").focus(function(){
		$(this).blur();
	});
});

