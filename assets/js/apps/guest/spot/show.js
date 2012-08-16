$(function() {
	var lat = $("#pg_spot_info").attr("data-lat");
	var lng = $("#pg_spot_info").attr("data-lng");
	var name = $("#pg_name").text();
	latlng = new google.maps.LatLng(lat, lng);
	var myOptions = {
		zoom: 10,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map($("#pg_map")[0], myOptions);
	var marker = new google.maps.Marker({
		map			: map,
		position	: latlng,
		title		: name,
		draggable	: false
	});
});