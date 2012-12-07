(function() {
	
	var map;
	var tour_current_window;
	var tour_marker_list = {};
	var tour_path_list = {};
	var lat_min = lat_max = lng_min = lng_max = null;

	var userCtl={};

	$(document).ready(function(){
		userCtl.init();
	});

	userCtl.init = function(){
	
		function mapInit() {
			var latlng = new google.maps.LatLng(35.6815, 139.786);
			var myOptions = {
				zoom: 12,
				center: latlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById("map"),myOptions);
			google.maps.event.addListener(map, 'dragend', function() {
				if ($("#pg_search_map_select").val() == "1") {
					show_tour(1);
				}
			});
			google.maps.event.addListener(map, 'zoom_changed', function() {
				if ($("#pg_search_map_select").val() == "1") {
					show_tour(1);
				}
			});
			google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
				show_tour(1);
			});
		}

	
		/**
		 * ツアー一覧表示
		 */
		function show_tour(page) {
			var limit = $("#pg_search_page_number").val();
			if (!limit) limit = 10;
			var request = {
					owner		: $("#pg_search_owner").val(),
					category	: $("#pg_search_category").val(),
					keyword		: $("#pg_search_keyword").val(),
					limit		: 10,
					sort		: $("#pg_search_order").val(),
					page		: page
			};
			
			if ($("#pg_search_map_select").val() == "1") {
				request.ne_lat = map.getBounds().getNorthEast().lat();
				request.ne_lng = map.getBounds().getNorthEast().lng();
				request.sw_lat = map.getBounds().getSouthWest().lat();
				request.sw_lng = map.getBounds().getSouthWest().lng();
			}
			$.ajax({
				url: gBaseUrl + "api/tour",
				data: request,
				dataType: "json",
				success: function(json) {
					$.each(tour_marker_list, function(idx, markers) {
						$.each(markers, function(marker_id, marker){
							marker.setMap(null);
						});
					});
					$.each(tour_path_list, function(idx, path) {
						path.setMap(null);
					});
					// テンプレートを除くリストクリア
					$("#pg_tours .list_item:not(.pg_tour_temp)").remove();
					if (json["count"] > 0) {
						$(".search_count").text(json["count"]);
						page_count = Math.ceil(json["count"] / limit);
						pager(page_count, page);
						
						google.maps.event.addListener(map, "click", function(e) {
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
									.attr("src", gBaseUrl + "uploads/tour/thumb/" + tour_info.image.file_name)
									.attr("alt", tour_info.name);
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
							tour_elm.find(".pg_category").append('<dt><img src="' + gAssetUrl + '/img/common/icon/category.gif" alt="CATEGORY" /></dt><dd>' + category_name.join(" > ") + '</dd>');
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
									var lat = route.lat;
									var lng = route.lng;
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
	
									var name = route.name;
									var latlng = new google.maps.LatLng(route.lat, route.lng);
									var marker = new google.maps.Marker({
										icon : gAssetUrl + "img/map/marker.png",
										shadow: gAssetUrl + "img/map/shadow.png",
										position	: latlng,
										title		: name,
										draggable	: false,
										visible		: false
									});
									/*
									if (i == 0) {
										marker.setIcon(gAssetUrl + '/img/map/icons/start.png');
									} else if(i == tour_info.routes.length - 1) {
										marker.setIcon(gAssetUrl + '/img/map/icons/finish.png');
									} else {
										marker.setIcon(gAssetUrl + '/img/map/icons/spot.png');
									}
									*/
									marker.setMap(map);
									google.maps.event.addListener(marker, "click", function(e) {
										if (tour_current_window) {
											tour_current_window.close();
										}
										var infowindow = new google.maps.InfoWindow({
											content		: route.name,
											position	: e.latLng,
										});
										infowindow.open(map);
										tour_current_window = infowindow;
									});
									_marker_list[route.id] = marker;
									path.push(marker.getPosition());
									tour_marker_list[tour_id] = _marker_list;
								}
							});
							if (path.length > 0) {
								linePath = new google.maps.Polyline({
									map				: map,
									path			: path,
									clickable		: true,
									geodesic		: true,
									strokeColor		: "#000099",
									strokeOpacity	: 0.2,
									strokeWeight	: 6,
									visible			: false
								});
								google.maps.event.addListener(linePath, "click", function(e) {
									if (tour_current_window) {
										tour_current_window.close();
									}
									var infowindow = new google.maps.InfoWindow({
										content		: tour_info.description,
										position	: e.latLng,
									});
									infowindow.open(map);
									tour_current_window = infowindow;
								});
								tour_path_list[tour_id] = linePath;
							}
						});
					}
					/*
					var ne = new google.maps.LatLng(lat_max, lng_max);
					var sw = new google.maps.LatLng(lat_min, lng_min);
					var bounds = new google.maps.LatLngBounds(sw, ne);
					map.fitBounds(bounds);
					*/
					
					var current_tour_id;
					var onmouse_tour_id;
					
					$("#pg_tours .pg_tour_list").bind("mouseenter", function() {
						if (onmouse_tour_id != current_tour_id) {
							if (onmouse_tour_id in tour_marker_list) {
								tour_path_list[onmouse_tour_id].setVisible(false);
							}
						}
						onmouse_tour_id = $(this).attr("data-tour-id");
						if (onmouse_tour_id != current_tour_id) {
							tour_path_list[onmouse_tour_id].setOptions({
								visible			: true,
								strokeOpacity	: 0.4,
								strokeColor		: "#0000ff",
								});
						}
					});
					
					$("#pg_tours .pg_tour_list").bind("mouseleave", function(event) {
						var leave_id = $(this).attr("data-tour-id");
						if (current_tour_id != leave_id) {
							tour_path_list[leave_id].setVisible(false);
						}
						event.stopPropagation();
					});
	
					$("#pg_tours .pg_tour_list").bind("click", function(event) {
						if (current_tour_id == $(this).attr("data-tour-id")) {
							return;
						}
						if (current_tour_id in tour_marker_list) {
							$.each(tour_marker_list[current_tour_id], function(i, marker) {
								marker.setVisible(false);
							});
							tour_path_list[current_tour_id].setVisible(false);
						}
						current_tour_id = $(this).attr("data-tour-id");
						$.each(tour_marker_list[current_tour_id], function(i, marker) {
							marker.setVisible(true);
						});
						tour_path_list[current_tour_id].setOptions({
							strokeOpacity	: 0.8,
							strokeColor		: "#0000ff",
							});
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
						map.fitBounds(bounds);
						event.stopPropagation();
					});
				}
			});
		}

		function pager(page_count, now) {
			$(".pagenation").paginate({
				count					: page_count,
				start					: now,
				display					: 10,
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
					show_tour(page);
				}
			});
		}
		
		mapInit();
		
		/* useredit */
		var editShowChk=false;
		$("#select_area .edit").on('click',function(){
			if(editShowChk){
				editClose();
			}else{
				editShow();
			}
			return false;
		});
		$("#select_area .close").on('click',function(){
			editClose();
			return false;
		});
		
		function editShow(){
			editShowChk=true;
			$("#edit_area").css("height","1px").css("display","block").stop().animate({height:244},300,"easeOutQuint");
		}
		function editClose(){
			editShowChk=false;
			$("#edit_area").stop().animate({height:1},300,"easeOutQuint",function(){$("#edit_area").css("display","none")});
		}
	}

})();