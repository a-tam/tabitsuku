(function() {

var spotentryCtl={};


$(document).ready(function(){
	spotentryCtl.init();
});

spotentryCtl.init=function(){
	
	var map;
	var marker_list = new Array();
	var info_list = new Array();
	var around_list = new Array();
	var current_window = null;
	var marker;
	
	function mapInit() {
		var lat = $('#spot-lat').val();
		var lng = $('#spot-lng').val();
		var myOptions;
		var latlng;
		var zoom;
		if (!lat) {
			if (!(lat = $.getUrlVars()["_lat"]) || !(lng = $.getUrlVars()["_lng"])) {
				lat = 35.6894875;
				lng = 139.69170639999993;
			}
		}
		zoom = $('#spot-zoom').val();
		if (!zoom) {
			if (!(zoom = $.getUrlVars()["_zoom"])) {
				zoom = 10;
			}
			$('#spot-zoom').val(zoom);
		}
		zoom = parseInt(zoom);
		latlng = new google.maps.LatLng(lat, lng);
		myOptions = {
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
		
		// MAP検索
		var input = document.getElementById('search-address');
		var autocomplete = new google.maps.places.Autocomplete(input);
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
		
		google.maps.event.addListener(map, 'projection_changed', function() {
			if ($('#spot-lat').val() && $('#spot-lng').val()) {
				marker.setPosition(latlng);
				setPosition(latlng);
			}
			search_spot(1);
		});
		google.maps.event.addListener(map, 'dragend', function() {
			search_spot(1);
		});
		google.maps.event.addListener(map, 'zoom_changed', function() {
			$('#spot-zoom').val(map.getZoom());
			search_spot(1);
		});

		function search_spot(mydata) {
			if (marker_list) {
				marker_list.forEach(function(marker, idx) {
					marker.setMap(null);
				});
			}
			var request = {
					limit: 100,
					owner: "mydata",
					ne_lat: map.getBounds().getNorthEast().lat(),
					ne_lng: map.getBounds().getNorthEast().lng(),
					sw_lat: map.getBounds().getSouthWest().lat(),
					sw_lng: map.getBounds().getSouthWest().lng()
			};
			$.ajax({
				url: gBaseUrl + "api/spot",
				async: false,
				data: request,
				dataType: "json",
				success: function(json) {
					$.each(json.list, function(id, spot) {
//							console.log(spot);
						if (spot.id != $('#spot-id').val()) {
							var latlng = new google.maps.LatLng(spot.lat, spot.lng);
							var marker = new google.maps.Marker({
								map: map,
								position: latlng,
//									icon : gAssetUrl + "img/map/icons/myMarker.png",
//									shadow: gAssetUrl + "img/map/icons/myShadow.png",
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
		}

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

		var update_timeout = null;
		google.maps.event.addListener(map, 'click', function(event){
			update_timeout = setTimeout(function(){
				marker.setPosition(event.latLng);
				setPosition(event.latLng);
			}, 300);
		});

		google.maps.event.addListener(map, 'dblclick', function(event){
			clearTimeout(update_timeout);
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

		$(".input_form").submit(function() {
			if (form_validate() == false) {
				return false;
			}
		});

		function form_validate() {
			var messages = [];
			var input_item = [];
			
			if ($("#spot-name").val().replace(/(^\s+)|(\s+$)/g, "") == "") {
				messages.push("スポット名の入力がありません");
				input_item.push("#spot-name");
			}
			
			if ($("#spot-description").val().replace(/(^\s+)|(\s+$)/g, "") == "") {
				messages.push("スポット説明の入力がありません");
				input_item.push("#spot-description");
			}
			
			if ($("#spot-lat").val() == "" || $("#spot-lng").val() == "") {
				messages.push("登録するスポットの位置をクリックしてください");
				input_item.push("#spot-lat");
				input_item.push("#spot-lng");
			}

			/*
			if ($("#tags").tagit("assignedTags").length == 0) {
				messages.push("タグの入力がありません");
				input_item.push("#tags");
			}*/
			
			if ($(".maincategory").length == 0) {
				messages.push("カテゴリの指定がありません");
				input_item.push(".input_form .categories");
			}

			if (messages.length > 0) {
				alert(messages.join("\n"));
				if (input_item) {
					$(input_item[0]).focus();
					$(input_item.join(",")).css("background-color", "#ffc").animate({
						backgroundColor: "#fff"
					}, 1500 );
				}
				return false;
			}
			return true;

		}

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

		$("#point_confirm").click(function(e) {
			if ($('#spot-lat').val() && $('#spot-lng').val()) {
				map.setCenter(marker.getPosition());
				search_spot();
			} else {
				alert("スポットの位置が指定されていません");
			}
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
				$.each(results, function() {
					if (this.types[0] == "administrative_area_level_1") {
						$("#spot-prefecture").val(this.address_components[0].long_name);
					}
				});
			} else {
			// エラーの場合
				$("#spot-address").val("");
			}
		});
		$("#spot-lat").val(location.lat());
		$("#spot-lng").val(location.lng());
		seach_around_spot(location);
	}
	
	function seach_around_spot(location) {
		if (around_list) {
			around_list.forEach(function(marker, idx) {
				marker.setMap(null);
			});
		}
		if (map.getZoom() < 15) {
			var request = {
					limit: 999,
					owner: "",
					ne_lat: location.lat() + 0.01,
					ne_lng: location.lng() + 0.01,
					sw_lat: location.lat() - 0.01,
					sw_lng: location.lng() - 0.01
			};
			
		} else {
			var request = {
					limit: 999,
					owner: "",
					ne_lat: map.getBounds().getNorthEast().lat(),
					ne_lng: map.getBounds().getNorthEast().lng(),
					sw_lat: map.getBounds().getSouthWest().lat(),
					sw_lng: map.getBounds().getSouthWest().lng()
			};
			
		} 
		$.ajax({
			url: gBaseUrl + "api/spot",
			async: false,
			data: request,
			dataType: "json",
			success: function(json) {
				$.each(json.list, function(id, spot) {
//						console.log(spot);
					$(".pg_around_number").text(json.count);
					if (spot.mydata != 1) {
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
						around_list[this.id] = marker;
					}
				});
			}
		});		
	}
	
	if ($(".pg_notification")) {
		setTimeout(function(){
			$(".pg_notification").slideUp("slow");
		}, parseInt(4 * 1000));
	}

	mapInit();
	commonCtl.registCategoryAddSet();
};
})();