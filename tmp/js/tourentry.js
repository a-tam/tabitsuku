(function() {

var tourentryCtl={};


$(document).ready(function(){
	tourentryCtl.init();
});

tourentryCtl.init=function(){
	
	
	function mapInit() {
		var latlng = new google.maps.LatLng(35.6815,139.786);
		var myOptions = {
			zoom: 12,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("map"),myOptions);
	
	}

	
	mapInit();
	commonCtl.registCategoryAddSet();
	
	$("#tour_make .list_area").scroll(tourListPosi);
	
	function tourListPosi(){
		if($("#tour_make .list_area").scrollTop()>10){
			$("#tour_make .starttime").stop().animate({opacity:0},200);
		}else{
			$("#tour_make .starttime").stop().animate({opacity:1},200);
		}
	}
	
	//block高さ調整
	function blockHeightAdjust(){
		var spotSearch=$("#spot_search");
		var tourMake=$("#tour_make");
		setInterval(heightAdjust,200);
		function heightAdjust(){
			var targetHeight=$("#basic_area").height();
			spotSearch.find(".list_area").css("height",targetHeight-spotSearch.find(".search_box").height()-spotSearch.find(".search_info").height()-spotSearch.find(".memo_item").height()-150+"px");
			tourMake.find(".list_area").css("height",targetHeight-283+"px");
			$("#joint span").css("height",spotSearch.find(".search_box").height()+39+"px");
		}
	}
	blockHeightAdjust();
	
	
	
	
	
	// inputpopup 
	$(window).resize(inputResize);
	
	function inputResize(){
		browser.sizeChk();
		var targetLeft=(1000-browser.width)*0.5;
		if(targetLeft>0){
			targetLeft=0;
		}
		$("#input_area").css("top",-($("header").height()+$("#globalnavi").height())-30+"px").css("left",targetLeft+"px");
		$("#input_area .cover").css("width",browser.width+"px").css("height",$(document).height()+"px");
		$("#input_box").css("left",(browser.width-500)*0.5+"px");
	}
	$("#tour_make .inputshowbtn").click(function(){
		inputShow();
		return false;
	});
	$("#input_area .cover,#input_area #input_box p.close").click(function(){
		inputHide();
		return false;
	});
	
	function inputShow(){
		inputResize();
		$("#input_area").fadeIn(300)
	}
	function inputHide(){
		$("#input_area").fadeOut(300)
	}
	
	
	inputResize();
}


})();