
$(function(){

	$("#BTN").on("click", OPENOPEN );
	
	function OPENOPEN(){
		$("#NAV").show();
		$("#XX").on("click", CLOSECLOSE );
	}
	
	function CLOSECLOSE(){
		$("#NAV").hide();
		$("#XX").off("click");
		
		$("#NAV").attr("style","");
	}
	
});


//JQ 的功能指令主要是直接把 CSS 寫入到 HTML 內部的 style 之內達到效果
//然而 JQ 產生的 HTML 內部 style CSS 容易跟我們寫的外部 CSS 產生衝突
//使用 attrattr("style","") 就可以把 JQ 產生的 style CSS 清除乾淨

