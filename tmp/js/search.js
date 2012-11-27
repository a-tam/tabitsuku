(function() {

var searchCtl={};


$(document).ready(function(){
	searchCtl.init();
});

searchCtl.init=function(){
	
	var routeItemNum=$(".routes .item").length;
	$(".list_area .list_item").each(function(index, element) {
		$(".list_area .subinfo").css("position","absolute").css("bottom","13px");
		$(".list_area .linkbtn").css("position","absolute").css("bottom","0px");
		$(this).find(".info_area").css("height",$(this).find(".maininfo").height()+$(this).find(".subinfo").height()+15+"px");
		
		var targetHeight=$(this).find(".sub_box").height()+30;
		if(targetHeight<$(this).find(".info_area").height()+13){
			targetHeight=$(this).find(".info_area").height()+13;
		}
		if(targetHeight<$(this).find(".photo").height()+13){
			targetHeight=$(this).find(".photo").height()+13;
		}
		$(this).find(".sub_box").css("height",targetHeight+"px");
	});
	
}


})();