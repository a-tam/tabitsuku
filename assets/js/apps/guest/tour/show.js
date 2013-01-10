$(function() {
	var directionsService = new google.maps.DirectionsService();
	var directionsDisplay = new google.maps.DirectionsRenderer({draggable: true});
	latlng = new google.maps.LatLng(35.6894875, 139.69170639999993);
	var myOptions = {
		zoom: 10,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map($("#map")[0], myOptions);
	
//	var path = [];
	
	var lat_min = lat_max = lng_min = lng_max = null;
	var waypoints = [];
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
				start = new google.maps.LatLng(lat, lng);
			} else {
				waypoints.push({location: new google.maps.LatLng(lat, lng)});
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
		}
	});
	var ne = new google.maps.LatLng(lat_max, lng_max);
	var sw = new google.maps.LatLng(lat_min, lng_min);
	var bounds = new google.maps.LatLngBounds(sw, ne);
	map.fitBounds(bounds);
	/*
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
	*/

	//	google.maps.event.addListener(directionsDisplay, "directions_changed", function() {
	//	calcRoute(directionsDisplay.directions);
	//});
	
	if (waypoints.length > 1) {
		waypoints.pop();
	}
	directionsDisplay.setMap(map);
	directionsService.route({
		origin : start,
		//waypoints: [ { location: "鈴鹿駅" }, { location :"名古屋駅" } ],
		waypoints: waypoints,
		destination: latlng,
		travelMode: google.maps.DirectionsTravelMode.DRIVING
	}, function(response, status){
		if (status == google.maps.DirectionsStatus.OK) {
			directionsDisplay.setDirections(response);
			calcRoute(response);
		}else{
			alert("ルート検索に失敗しました");
		}
	});
	
	function calcRoute(response){
		var m = 0;
		for(var i=0; i<response.routes[0].legs.length; i++){
			m += response.routes[0].legs[i].distance.value;	// 距離(m)
		}
		$("#route_distance").text("総移動距離："+m+"メートル");
	}
	// 情報ウィンドウを探し出して現在時刻に書き換える
	function changeText(){
		var iwList = document.getElementById("gmap").getElementsByTagName("div");
		for(var i=0; i<iwList.length; i++){
			if (iwList[i].style.direction == "ltr"){
				iwList[i].innerHTML = new Date();
			}
		}
	}

	$(".linkbtn a").live("click", function() {
		spotCtl.popup($(this).attr("href"));
		return false;
	});
	
	$(".pg_delete").live("click", function() {
		return confirm("本当に削除しますか？");
	});

	$("#pg_fb_event_add").submit(function() {
		$.ajax({
			url: "/api/tour/fb_event_add",
			type: "post",
			data: $("#pg_fb_event_add").serialize(),
			dataType: "json",
			success: function(json) {
				if (json.status == "error") {
					if (json.result == "permission") {
				      	window.open(json.info.login_url);
					} 
				} else {
					alert("Facebookにイベントを登録しました");
					var result_anchor = $(document.createElement('a'))
						.attr({
							'target': "_blank",
							'href': "https://www.facebook.com/events/"+json.result,
						})
						.text("登録したイベントを表示する");
					$("#pg_fb_event_result").append(result_anchor);
					$("#pg_fb_event_add").reset();
				}
			}
		});
		return false;
	});
});