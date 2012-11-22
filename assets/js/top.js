(function() {

var topCtl={};


$(document).ready(function(){
	topCtl.init();
});

topCtl.init=function(){
	
	
	
	commonCtl.listHeightAdjust();
	
	$("#mainvisual h2").delay(800).fadeIn(600,"easeInSine");
	$(".message-area p").delay(1100).fadeIn(600,"easeInSine");
	$(".message-area li").eq(0).delay(1500).fadeIn(800,"easeInSine");
	$(".message-area li").eq(1).delay(1700).fadeIn(800,"easeInSine");
	
}


})();