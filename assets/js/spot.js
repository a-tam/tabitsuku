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

	
	mapInit();
	commonCtl.listHeightAdjust();
	
}


})();