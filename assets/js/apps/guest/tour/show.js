$(function() {
	latlng = new google.maps.LatLng(35.6894875, 139.69170639999993);
	var myOptions = {
		zoom: 10,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map($("#pg_map")[0], myOptions);
	var path = [];
	
	var lat_min = lat_max = lng_min = lng_max = null;
	$(".pg_spot").each(function(i, elm) {
		var id = $(elm).attr("data-spot-id");
		if (id) {
			var lat = $(elm).attr("data-lat");
			var lng = $(elm).attr("data-lng");
			if (lat_min == null) {
				lat_min = lat;
				lat_max = lat;
				lng_min = lng;
				lng_max = lng;
			}
			if (lat <= lat_min) { lat_min = lat; }
			if (lat >  lat_max) { lat_max = lat; }
			if (lng <= lng_min) { lng_min = lng; }
			if (lng >  lng_max) { lng_max = lng; }
			latlng = new google.maps.LatLng(lat, lng);
			marker = new google.maps.Marker({
				map			: map,
				position	: latlng
			});
			
			if (i == 0) {
				marker.setIcon(gAssetUrl + '/img/map/icons/start.png');
			} else if(i == $(".pg_spot").length - 1) {
				marker.setIcon(gAssetUrl + '/img/map/icons/finish.png');
			} else {
				marker.setIcon(gAssetUrl + '/img/map/icons/spot.png');
			}
			path.push(marker.getPosition());
		}
	});
	var ne = new google.maps.LatLng(lat_max, lng_max);
	var sw = new google.maps.LatLng(lat_min, lng_min);
	var bounds = new google.maps.LatLngBounds(sw, ne);
	map.fitBounds(bounds);
	console.log(path);
	if (path.length > 0) {
		linePath = new google.maps.Polyline({
			map				: map,
			path			: path,
			clickable		: false,
			geodesic		: true,
			strokeColor		: "#000099",
			strokeOpacity	: 0.6,
			strokeWeight	: 6,
			visible			: true
		});
	}
});