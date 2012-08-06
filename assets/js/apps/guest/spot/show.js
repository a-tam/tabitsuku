$(function() {
	latlng = new google.maps.LatLng(35.6894875, 139.69170639999993);
	var myOptions = {
		zoom: 10,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map($("#pg_map")[0], myOptions);
});