var spot_map;
var tour_map;

var spot_marker_list = [];
var spot_current_window;

var tour_marker_list = {};
var tour_path_list = [];
var tour_current_window;
$(function() {

	var tabIndexs = {'pg_tabs_tour' : 0, 'pg_tabs_spot' : 1};
	var tab_index = tabIndexs[window.location.hash.slice(3)];
	tab_index = tab_index ? tab_index : 0;
	
	$( "#pg_tabs" ).tabs({
		selected: tab_index,
		show: function(event, ui){
			if (ui.index == 0) {
				if (!tour_map) {
					tour_map = new google.maps.Map($("#pg_tabs_tour").find(".pg_map")[0], {
						zoom: 10,
						center: new google.maps.LatLng(35.6894875, 139.69170639999993),
						mapTypeId: google.maps.MapTypeId.ROADMAP
					});
					google.maps.event.addListener(tour_map, 'dragend', function() {
						show_tour(1);
					});
					google.maps.event.addListener(tour_map, 'zoom_changed', function() {
						show_tour(1);
					});
					google.maps.event.addListenerOnce(tour_map, 'tilesloaded', function() {
						show_tour(1);
					});
				}
			} else if (ui.index==1) {
				if (!spot_map) {
					spot_map = new google.maps.Map($("#pg_tabs_spot").find(".pg_map")[0], {
						zoom: 10,
						center: new google.maps.LatLng(35.6894875, 139.69170639999993),
						mapTypeId: google.maps.MapTypeId.ROADMAP
					});
					google.maps.event.addListener(spot_map, 'dragend', function() {
						show_spot(1);
					});
					google.maps.event.addListener(spot_map, 'zoom_changed', function() {
						show_spot(1);
					});
					google.maps.event.addListenerOnce(spot_map, 'tilesloaded', function() {
						show_spot(1);
					});
				}
			}
		},
		select: function(event, ui) {
			window.location.hash = "!" + ui.tab.hash;
		}
	});
	
	$(window).bind("hashchange", function(){
		var index = tabIndexs[window.location.hash.slice(3)];
		index = index ? index : 0;
		$('#pg_tabs').tabs("select", index);
	});

	function pager(page_count, now) {
		$("#pg_tabs_spot #pg_pagenation").paginate({
			count					: page_count,
			start					: now,
			display					: 6,
			border					: true,
			border_color			: '#fff',
			text_color  			: '#fff',
			background_color    	: 'black',
			border_hover_color		: '#ccc',
			text_hover_color  		: '#000',
			background_hover_color	: '#fff',
			images					: false,
			mouse					: 'press',
			onChange				: function(page) {
				search(page);
			}
		});
	}

	/**
	 * スポット一覧表示
	 */
	function show_spot(page) {
		if (!page) {
			page = 1;
		}
		if (spot_marker_list) {
			spot_marker_list.forEach(function(marker, idx) {
				marker.setMap(null);
			});
		}
		$.ajax({
			url: gBaseUrl + "api/spot",
			data: {
				owner:		"mydata",
				category:	$("#pg_spot_search_category").val(),
				keyword:	$("#pg_spot_keyword").val(),
				limit:		$("#pg_spot_limit").val(),
				sort:		$("#pg_spot_sort").val(),
				page:		page,
				ne_lat:		spot_map.getBounds().getNorthEast().lat(),
				ne_lng:		spot_map.getBounds().getNorthEast().lng(),
				sw_lat:		spot_map.getBounds().getSouthWest().lat(),
				sw_lng:		spot_map.getBounds().getSouthWest().lng()
			},
			dataType: "json",
			success: function(json) {
				// テンプレートを除くリストクリア
				$("#pg_spots li:not(.pg_spot_temp)").html("");
				if (json["count"] > 0) {
					// 
					google.maps.event.addListener(spot_map, "click", function(e) {
						if (spot_current_window) {
							spot_current_window.close();
						}
					});
					$.each(json["list"], function(spot_id, spot_info) {
						// テンプレートのクローン作成
						var spot_elm = $(".pg_spot_temp")
							.clone(true)
							.removeClass("pg_spot_temp")
							.css("display", "block")
							.attr("data-spot-id", spot_id);
						// スポット名
						spot_elm.find(".pg_name")
							.text(spot_info.name);
						// 画像
						if (spot_info.image) {
							spot_elm.find(".pg_image")
								.attr("src", gBaseUrl + "uploads/spot/thumb/" + spot_info.image.file_name);
						}
						// 滞在時間
						spot_elm.find(".pg_stay_time")
							.text(spot_info.stay_time + "分");
						// カテゴリ
						spot_elm.find(".pg_category").empty();
						$(spot_info.category.split(",")).each(function(i, category) {
							var category_name = [];
							$(category.match(/\d+/g)).each(function(i, category_id) {
								category_name.push(json["relation"]["categories"][category_id]);
							});
							spot_elm.find(".pg_category").append("<li>" + category_name.join(" > ") + "</li>");
						});
						// 内容
						spot_elm.find(".pg_description").text(spot_info.description);
						// タグ
						spot_elm.find(".pg_tags").empty();
						$(spot_info.tags.match(/\d+/g)).each(function(i, tag_id) {
							spot_elm.find(".pg_tags").append("<li>" + json["relation"]["tags"][tag_id] + "</li>");
						});
						// リンク
						spot_elm.find(".pg_detail")
							.attr("href", gBaseUrl + "spot/show/" + spot_info.id);
						spot_elm.find(".pg_edit")
							.attr("href", gBaseUrl + "user/spot/form/" + spot_info.id);
						spot_elm.find(".pg_delete")
							.attr("href", gBaseUrl + "user/spot/delete/" + spot_info.id);
						spot_elm.appendTo("#pg_spots");
						// 地図にマーカー表示
						var latlng = new google.maps.LatLng(spot_info.lat, spot_info.lng);
						var marker = new google.maps.Marker({
							map			: spot_map,
							position	: latlng,
							title		: spot_info.name,
							draggable	: false
						});
						// 情報ウィンドウ表示
						google.maps.event.addListener(marker, "click", function() {
							if (spot_current_window) {
								spot_current_window.close();
							}
							var content = "";
							if (spot_info.image) {
								content += '<img style="float:left;" src="' + gBaseUrl + 'uploads/spot/thumb/' + spot_info.image.file_name+'" width="60" height="60" alt="" />';
							}
							content += "<b>"+spot_info.name + "</b><br />" + spot_info.description;
							var infowindow = new google.maps.InfoWindow({
								content		: content,
								position	: marker.getPosition()
							});
							infowindow.open(spot_map);
							spot_current_window = infowindow;
						});
						spot_marker_list[spot_info.id] = marker;
					});
				}
			}
		});
	}

	/**
	 * ツアー一覧表示
	 */
	function show_tour(page) {
		$.ajax({
			url: gBaseUrl + "api/tour",
			data: {
				owner:		"mydata",
				category:	$("#pg_tour_search_category").val(),
				keyword:	$("#pg_tour_keyword").val(),
				limit:		$("#pg_tour_limit").val(),
				sort:		$("#pg_tour_sort").val(),
				page:		page,
				ne_lat:		tour_map.getBounds().getNorthEast().lat(),
				ne_lng:		tour_map.getBounds().getNorthEast().lng(),
				sw_lat:		tour_map.getBounds().getSouthWest().lat(),
				sw_lng:		tour_map.getBounds().getSouthWest().lng()
			},
			dataType: "json",
			success: function(json) {
				$.each(tour_marker_list, function(marker, idx) {
					marker.setMap(null);
				});
				$.each(tour_path_list, function(path, idx) {
					path.setMap(null);
				});
				// テンプレートを除くリストクリア
				$("#pg_tours li:not(.pg_tour_temp)").html("");
				if (json["count"] > 0) {
					google.maps.event.addListener(tour_map, "click", function(e) {
						if (tour_current_window) {
							tour_current_window.close();
						}
					});
					$.each(json["list"], function(tour_id, tour_info) {
						// テンプレートのクローン作成
						var tour_elm = $(".pg_tour_temp")
							.clone(true)
							.removeClass("pg_tour_temp")
							.css("display", "block")
							.attr("data-tour-id", tour_id);
						// ツアー名 
						tour_elm.find(".pg_name")
							.text(tour_info.name);
						// いいねボタン
						tour_elm.find(".pg_like_count")
							.addClass("fb-like")
							.attr("data-href", gBaseUrl + 'user/tour/show/' + tour_info.id);
						// 画像
						if (tour_info.image) {
							tour_elm.find(".pg_image")
								.attr("src", gBaseUrl + "uploads/tour/thumb/" + tour_info.image.file_name);
						}
						// 滞在時間
						var stay_time = 0;
						$(this.routes).each(function(i, route) {
							stay_time += (route.stay_time * 1);
						});
						tour_elm.find(".pg_stay_time")
							.text(stay_time + "分");
						// 内容
						tour_elm.find(".pg_description").text(tour_info.description);
						// カテゴリ
						tour_elm.find(".pg_category").empty();
						var category_name = [];
						if (tour_info.category) {
							$(tour_info.category.match(/\d+/g)).each(function(i, category_id) {
								category_name.push(json["relation"]["categories"][category_id]);
							});
						}
						tour_elm.find(".pg_category").append("<li>" + category_name.join(" > ") + "</li>");
						// タグ
						tour_elm.find(".pg_tags").empty();
						if (tour_info.tags) {
							$(tour_info.tags.match(/\d+/g)).each(function(i, tag_id) {
								tour_elm.find(".pg_tags").append("<li>" + json["relation"]["tags"][tag_id] + "</li>");
							});
						}
						// リンク
						tour_elm.find(".pg_detail")
							.attr("href", gBaseUrl + "tour/show/" + tour_info.id);
						tour_elm.find(".pg_copy")
							.attr("href", gBaseUrl + 'user/tour/copy/' + tour_info.id);
						tour_elm.find(".pg_edit")
							.attr("href", gBaseUrl + "user/tour/form/" + tour_info.id);
						tour_elm.find(".pg_delete")
							.attr("href", gBaseUrl + "user/tour/delete/" + tour_info.id);
						tour_elm.appendTo("#pg_tours");
						// 
						path = [];
						var _marker_list = {};
						$(tour_info.routes).each(function(i, route) {
							if (route.id) {
								var name = route.name;
								var latlng = new google.maps.LatLng(route.lat, route.lng);
								var marker = new google.maps.Marker({
									position	: latlng,
									title		: name,
									draggable	: false,
									visible		: false
								});
								if (i == 0) {
									marker.setIcon(gAssetUrl + '/img/map/icons/start.png');
								} else if(i == tour_info.routes.length - 1) {
									marker.setIcon(gAssetUrl + '/img/map/icons/finish.png');
								}
								marker.setMap(tour_map);
								google.maps.event.addListener(marker, "click", function(e) {
									if (tour_current_window) {
										tour_current_window.close();
									}
									var infowindow = new google.maps.InfoWindow({
										content		: route.name,
										position	: e.latLng,
									});
									infowindow.open(tour_map);
									tour_current_window = infowindow;
								});
								_marker_list[route.id] = marker;
								path.push(marker.getPosition());
								tour_marker_list[tour_id] = _marker_list;
							}
						});
						if (path.length > 0) {
							linePath = new google.maps.Polyline({
								map				: tour_map,
								path			: path,
								clickable		: true,
								geodesic		: true,
								strokeColor		: "#000099",
								strokeOpacity	: 0.2,
								strokeWeight	: 3
							});
							google.maps.event.addListener(linePath, "click", function(e) {
								if (tour_current_window) {
									tour_current_window.close();
								}
								var infowindow = new google.maps.InfoWindow({
									content		: tour_info.description,
									position	: e.latLng,
								});
								infowindow.open(tour_map);
								tour_current_window = infowindow;
							});
							tour_path_list[tour_id] = linePath;
						}
					});
				}
				
				var current_tour_id;
				
				$("#pg_tours .pg_tour_list").bind("mouseenter", function() {
					current_tour_id = $(this).attr("data-tour-id");
					$.each(tour_marker_list[current_tour_id], function(i, marker) {
						marker.setVisible(true);
					});
					tour_path_list[current_tour_id].setOptions({strokeOpacity: 1});
				});
				
				$("#pg_tours .pg_tour_list").bind("mouseleave", function() {
					current_tour_id = $(this).attr("data-tour-id");
					$.each(tour_marker_list[current_tour_id], function(i, marker) {
						marker.setVisible(false);
					});
					tour_path_list[current_tour_id].setOptions({strokeOpacity: 0.2});
				});

				$("#pg_tours .pg_tour_list").bind("click", function() {
					current_tour_id = $(this).attr("data-tour-id");
					var lat_min = lat_max = lng_min = lng_max = null;
					$.each(tour_marker_list[current_tour_id], function(i, marker) {
						var lat = marker.getPosition().lat();
						var lng = marker.getPosition().lng();
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
					});
					var ne = new google.maps.LatLng(lat_max, lng_max);
					var sw = new google.maps.LatLng(lat_min, lng_min);
					var bounds = new google.maps.LatLngBounds(sw, ne);
					tour_map.fitBounds(bounds);
				});
			}
		});
	}
});