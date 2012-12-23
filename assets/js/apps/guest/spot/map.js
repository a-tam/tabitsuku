(function() {
	
	var map;
	var spot_current_window;
	var spot_marker_list = {};
	var spot_path_list = {};
	var lat_min = lat_max = lng_min = lng_max = null;
	var spot_list;
	var userCtl={};
	var map_event_enable = true;

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
				if ($("#pg_search_map_select:checked")) {
					show_spot(1);
				}
			});
			google.maps.event.addListener(map, 'zoom_changed', function() {
				if ($("#pg_search_map_select:checked") && map_event_enable == true) {
					show_spot(1);
				}
			});
			google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
				show_spot(1);
			});
			
			commonCtl.searchBoxSet.setFunc = function() {
				show_spot(1);
			};
			commonCtl.searchBoxSet.unsetFunc = function() {
				show_spot(1);
			};
			
			$.each(["#pg_search_keyword",
			        ".search_box input[name='category']", 
			        "#pg_search_page_number", 
			        "#pg_search_order", 
			        "#pg_search_owner",
			        "#pg_search_map_select"], function(i, elm_id) {
				$(elm_id).change(function() {
					show_spot(1);
				});
			});
			
			$(".search_box .pg_search_map_btn").on("click", function() {
				show_spot(1);
				return false;
			});
			
		}

		
	
		/**
		 * ツアー一覧表示
		 */
		function show_spot(page) {
			var limit = $("#pg_search_page_number").val();
			if (!limit) limit = 10;
			var request = {
					owner		: $("#pg_search_owner:checked").val(),
					category	: $(".search_box input[name='category']").val(),
					keyword		: $("#pg_search_keyword").val(),
					limit		: limit,
					sort		: $("#pg_search_order").val(),
					page		: page
			};
			
			if ($("#pg_search_map_select:checked").val() == "1") {
				request.ne_lat = map.getBounds().getNorthEast().lat();
				request.ne_lng = map.getBounds().getNorthEast().lng();
				request.sw_lat = map.getBounds().getSouthWest().lat();
				request.sw_lng = map.getBounds().getSouthWest().lng();
			}
			//return false;
			$.ajax({
				url: gBaseUrl + "api/spot",
				data: request,
				dataType: "json",
				success: function(json) {
					spot_list = {};
					// テンプレートを除くリストクリア
					$("#pg_spots .list_item:not(.pg_temp)").remove();
					$.each(spot_marker_list, function(spot_id, marker) {
						marker.setMap(null);
					});
					if (json["count"] > 0) {
						// pager
						$(".search_count").text(json["count"]);
						page_count = Math.ceil(json["count"] / limit);
						pager(page_count, page);
						// 
						google.maps.event.addListener(map, "click", function(e) {
							close_info_window();
						});
						// show list
						$.each(json["list"], function(spot_id, spot_info) {
							// render spot
							spotCtl.render(spot_info, json["relation"], "#pg_spots");
							spot_list[spot_id] = spot_info;
							// 地図にマーカー表示
							var latlng = new google.maps.LatLng(spot_info.lat, spot_info.lng);
							var marker = new google.maps.Marker({
								icon : gAssetUrl + "img/map/marker.png",
								shadow: gAssetUrl + "img/map/shadow.png",
								map			: map,
								position	: latlng,
								title		: spot_info.name,
								draggable	: false
							});
							// 情報ウィンドウ表示
							google.maps.event.addListener(marker, "click", function() {
								open_info_window(spot_info.id);
								var spot = $('.list_area [data-spot-id="' + spot_info.id + '"]');
								$(".list_area")
									.animate({scrollTop: $(".list_area").scrollTop() + $(spot).position().top}, "first");
								spot.addClass("active");
							});
							spot_marker_list[spot_info.id] = marker;
						});
					}
				}
			});
		}

		var current_spot_id;
		var onmouse_spot_id;
		
		$("#pg_spots .pg_spot_list").bind("mouseenter", function() {
			if (onmouse_spot_id != current_spot_id) {
			}
			onmouse_spot_id = $(this).attr("data-spot-id");
			if (onmouse_spot_id != current_spot_id) {
			}
		});
		
		$("#pg_spots .pg_spot_list").bind("mouseleave", function(event) {
			var leave_id = $(this).attr("data-spot-id");
			if (current_spot_id != leave_id) {
			}
//			event.stopPropagation();
		});

		$("#pg_spots .pg_spot_list").bind("click", function(event) {
			current_spot_id = $(this).attr("data-spot-id");
			var zoom = $(this).attr("data-zoom");
			open_info_window(current_spot_id);
			map.setCenter(spot_marker_list[current_spot_id].getPosition());
			if (zoom) {
				map_event_enable = false;
				map.setZoom(parseInt(zoom));
				map_event_enable = true;
			}
			event.stopPropagation();
		});

		function open_info_window(id) {
			var spot_info = spot_list[id];
			close_info_window(id);
			var content = "";
			if (spot_info.image) {
				content += '<img style="float:left;" src="' + gBaseUrl + 'uploads/spot/thumb/' + spot_info.image.file_name+'" width="60" height="60" alt="" />';
			}
			content += "<b>"+spot_info.name + "</b><br />" + spot_info.description;
			var infowindow = new google.maps.InfoWindow({
				content		: content,
				position	: new google.maps.LatLng(spot_info.lat, spot_info.lng)
			});
			infowindow.open(map);
			spot_current_window = infowindow;
		}

		function close_info_window(id) {
			if (spot_current_window) {
				spot_current_window.close();
				$('[data-spot-id="' + id + '"]').each(function(i, spot) {
					$(spot).removeClass("active");
				});
			}
		}

		function pager(page_count, now) {
			$(".pager").simplePaginate({
				count		: page_count,
				current		: now,
				onChange	: function(page) {
					show_spot(page);
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

		$(".pg_delete").live('click',function(){
			if (confirm("本当に削除しますか？")) {
				if ($(".jPag-current")) {
					page = $.text($(".jPag-current")[0]);
				} else {
					page = 1;
				}
				$.get($(this).attr("href"));
				show_spot(page);
			}
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
	};

})();