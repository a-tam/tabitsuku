(function() {

var spotentryCtl={};


$(document).ready(function(){
	spotentryCtl.init();
});

spotentryCtl.init=function(){
	
	var map;
	
	function mapInit() {
		var lat = $('#spot-lat').val();
		var lng = $('#spot-lng').val();
		var latlng = new google.maps.LatLng(lat, lng);
		var zoom = 10;
		if ("" != $('#spot-id').val()) {
			zoom = 17;
		}
		var myOptions = {
			zoom: zoom,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("map"), myOptions);
		// マーカー表示
		marker = new google.maps.Marker({
			map: map,
			draggable: true,
			icon : gAssetUrl + "img/map/marker.png",
			shadow: gAssetUrl + "img/map/shadow.png",
		});
		marker.setPosition(latlng);
		
		// MAP検索
		var input = document.getElementById('search-address');
		var autocomplete = new google.maps.places.Autocomplete(input);
		setPosition(latlng);
		autocomplete.bindTo('bounds', map);

		$("#search-map").submit(function(){
			var adrs = $("#search-address").val();
			var gc = new google.maps.Geocoder();
			gc.geocode({ address : adrs }, function(results, status){
				if (status == google.maps.GeocoderStatus.OK) {
					var ll = results[0].geometry.location;
					map.setCenter(ll);
					map.fitBounds(results[0].geometry.viewport);
				} else {
					$("#search-address").select();
					$("#falledMessage").show().fadeOut(4000);
				}
			});
			return false;
		});

		google.maps.event.addListener(marker, 'dragend', function() {
			setPosition(this.getPosition());
		});
			
		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			var place = autocomplete.getPlace();
			if (place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
			} else {
				map.setCenter(place.geometry.location);
				map.setZoom(17);  // Why 17? Because it looks good.
			}
			//
			var _place = $("#search-place").val();
			var _name = $("#search-name").val();
			var request = {
				location: place.geometry.location,
				radius: '500',
				types: [_place],
				name: _name
			};
//				infowindow = new google.maps.InfoWindow();
//				service = new google.maps.places.PlacesService(map);
//				service.search(request, callback);
				// 検索結果の中央座標設定
			setPosition(place.geometry.location);
		});

		google.maps.event.addListener(map, 'click', function(event){
			marker.setPosition(event.latLng);
			setPosition(event.latLng);
		});

		$(document).click(function(e) {
			$(".select-category").hide("fast");
		});
		// カテゴリ入力クリア
		$(".category_clear").click(function(e){
			$(this).parent().find(".category_val, .category_label").val("");
		});

		$(".category_label").click(function(e, elm) {
			var current_category = $(this).parent().find(".select-category");
			$(".select-category").not(current_category).hide("fast");
			$(current_category).css({
				"left": $(this).position().left + 25,
				"width": $(this).css("width") - 25
			}).toggle("fast");
			e.stopPropagation();
		});

		$(".select-category").click(function(e) {
			e.stopPropagation();
		});

		/*
		$(".select-category").each(function() {
			var path = $(this).parent().find(".category_val").val();
			var current = 1;
			var node = [];
			if (path) {
				path_split = path.split("/");
				current = path_split[path_split.length - 2];
				node = [ "node_"+current ];
			}
			$(this).jstree({
				"json_data" : {
					"ajax": {
						"url": gBaseUrl + "user/category/tree/" + current,
						"data": function(n) {
							return {
								"opration": "get_children",
								"id": n.attr ? n.attr("id").replace("node_", ""): ""
							};
						}
					}
				},
				"ui" : {
					"initially_select": node
				},
				"plugins" : [ "themes", "json_data", "ui" ]
			}).bind("select_node.jstree", function (e, data) {
				$(this).parent().find(".category_label").val($(this).jstree("get_path", data.rslt.obj, false).join(" > "));
				$(this).parent().find(".category_val").val("/"+$(this).jstree("get_path", data.rslt.obj, true).join("/").replace(/node_/g, "")+"/");
				$(this).hide();
			});
		});
		*/

		var marker_list = new Array();
		var info_list = new Array();
		var current_window = null;
		$("#point_confirm").click(function(e) {
			map.setCenter(marker.getPosition());
			if (map.getZoom() < 17) {
				map.setZoom(17);
			}
			$.ajax({
				url: gBaseUrl + "user/tour/query",
				async: false,
				data: {
					limit	: 999,
					ne_lat	: map.getBounds().getNorthEast().lat(),
					ne_lng	: map.getBounds().getNorthEast().lng(),
					sw_lat	: map.getBounds().getSouthWest().lat(),
					sw_lng	: map.getBounds().getSouthWest().lng()
				},
				dataType: "json",
				success: function(json) {
					if (marker_list) {
						marker_list.forEach(function(marker, idx) {
							marker.setMap(null);
						});
					}
					$.each(json.list, function(id, spot) {
						console.log(spot);
						if (spot.id != $('#spot-id').val()) {
							var latlng = new google.maps.LatLng(spot.lat, spot.lng);
							var marker = new google.maps.Marker({
								map: map,
								position: latlng,
								icon : gAssetUrl + "img/map/icons/myMarker.png",
								shadow: gAssetUrl + "img/map/icons/myShadow.png",
								title: spot.name,
								draggable: false
							});
							google.maps.event.addListener(marker, "click", function() {
								if (current_window) {
									current_window.close();
								}
								var content = "";
								if (spot.image) {
									content += '<img style="float:left;" src="' + gBaseUrl + 'uploads/spot/thumb/' + spot.image.file_name+'" width="60" height="60" alt="" />';
								}
								content += "<b>"+spot.name + "</b><br />" + spot.description;
								var infowindow = new google.maps.InfoWindow({
									content: content
								});
								infowindow.open(map, marker);
								current_window = infowindow;
							});
							marker_list[this.id] = marker;
						}
					});
				}
			});
			return false;
		});
		
		$("#tags").tagit({
			itemName: "tags",
			fieldName: "name",
			tagSource: function(search, showChoices) {
				$.ajax({
					url : gBaseUrl + 'user/tag/search',
					data: { term: search.term },
					dataType : 'json',
					success: function(data) {
						showChoices(data);
					}
				});
			}
		});
		
		$("#headerSaveArea").click(function() {
			$("#spot-form").submit();
			return false;
		});
	
	}

	function callback(results, status) {
		if (status == google.maps.places.PlacesServiceStatus.OK) {
			for (var i=0; i < results.length; i++) {
				var place=results[i];
				createMarker(results[i]);
			}
		}
	}

	function createMarker(place) {
		var placeLoc=place.geometry.location;
		var marker = new google.maps.Marker({
			map: map,
			position: new google.maps.LatLng(placeLoc.lat(), placeLoc.lng())
		});
		google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(place.name);
			infowindow.open(map, this);
		});
	}
	
	function setPosition(location) {
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({latLng: location}, function(results, status){
			if(status == google.maps.GeocoderStatus.OK){
			// 正常に処理ができた場合
				$("#spot-address").val(results[0].formatted_address);
			} else {
			// エラーの場合
				$("#spot-address").val("");
			}
		});
		$("#spot-lat").val(location.lat());
		$("#spot-lng").val(location.lng());
	}

	mapInit();
	commonCtl.registCategoryAddSet();
}


})();