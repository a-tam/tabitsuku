(function() {

var topCtl={};


$(document).ready(function(){
	topCtl.init();
});

topCtl.init=function(){
	
	
	
	commonCtl.listHeightAdjust();
	
	$(".search_area .area .submit").click(function() {
		if ($("#areasearch-tour:checked").length > 0) {
			$(".area form").attr("action", "guest/tour/map");
		} else {
			$(".area form").attr("action", "guest/spot/map");
		}
	});
	
	$(".search_area .keyword .submit").click(function() {
		if ($("#keywordsearch_tour:checked").length > 0) {
			$(".keyword form").attr("action", "tour/search");
		} else {
			$(".keyword form").attr("action", "spot/search");
		}
	});

	$("#mainvisual h2").delay(800).fadeIn(600,"easeInSine");
	$(".message-area p").delay(1100).fadeIn(600,"easeInSine");
	$(".message-area li").eq(0).delay(1500).fadeIn(800,"easeInSine");
	$(".message-area li").eq(1).delay(1700).fadeIn(800,"easeInSine");
	
}


})();