(function() {

var spotCtl={};


$(document).ready(function(){
	spotCtl.init();
});

spotCtl.init=function(){
	
	
	function mapInit() {
		var latlng = new google.maps.LatLng(35.6815,139.786);
		var myOptions = {
			zoom: 12,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("map"),myOptions);
	
	}

	var routeItemNum=$(".routes .item").length;
	$(".routes .item").each(function(index, element) {
		$(this).css("z-index",routeItemNum-index);
		if(index==routeItemNum-1){
			$(this).find(".time span").css("display","none");
		}
		if($(this).find(".subinfo").height()<$(this).find(".info_area").height()+8){
			$(this).find(".subinfo").css("height",$(this).find(".info_area").height()+8+"px");
		}
	});
	
	
	mapInit();
	
}


})();