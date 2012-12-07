var tourentryCtl={};

$(document).ready(function(){
	tourentryCtl.init();
});

tourentryCtl.init=function(){
	
	var map = null;
	var current_window = null;
	var current_window_id = null;
	var marker_list = new Array();
	var info_list = new Array();
	var latlng = {};
	var myOptions = {};
	var linePath = null;
	
	commonCtl.searchBoxSet.setFunc = function() {
		search();
		return false;
	};
	commonCtl.searchBoxSet.unsetFunc = function() {
		search();
		return false;
	};
	
	function mapInit() {
		var latlng = new google.maps.LatLng(35.6815,139.786);
		var myOptions = {
			zoom: 12,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("map"),myOptions);

		tour_center();
		// 地図検索
		var autocomplete = new google.maps.places.Autocomplete($('#search-address')[0]);
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
		// 移動
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
			var request={
					location: place.geometry.location,
					radius: '500',
					types: [_place],
					name: _name
				};
			// 検索結果の中央座標設定
//			setPosition(place.geometry.location);
		});
		// スポット一覧再検索
		$("#category,#keyword,#season,#limit,#sort").change(function() {
			search();
		});
		
		google.maps.event.addListener(map, 'dragend', function() {
			search();
		});
		google.maps.event.addListener(map, 'zoom_changed', function() {
			search();
		});
		google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
			search(1);
		});
		$("#search").click(function() {
			search();
		});
		$("#spotFilterButton").click(function() {
			search();
		});
		$(".search_box .search-btn").click(function() {
			search();
		});
		$("#userspot").change(function() {
			search();
		});
		// 予定時刻を反映
		change_time();
		// ツアーにスポット追加
		$(".iconAdd").live("click", function() {
			var self = $(this).closest(".tour_point");
			self.clone().hide().appendTo($("#tour_make .list_area")).fadeIn("slow");
			change_time();
			return false;
		});
		// ツアーにスポット解除
		$(".iconClose").live("click", function() {
			$(this).closest(".tour_point").fadeOut(300).queue(function(){ $(this).remove();});
			change_time();
			return false;
		});
		// 予定のスポットを入れ替え（上）
		$(".iconUp").live("click", function() {
			var self = $(this).closest(".tour_point");
			self.insertBefore(self.prev());
			change_time();
			return false;
		});
		// 予定のスポットを入れ替え（下）
		$(".iconDown").live("click", function() {
			var self = $(this).closest(".tour_point");
			self.insertAfter(self.next());
			change_time();
			return false;
		});
		// スポットのソート、滞在時間変更で予定時刻を変更
		$("#start_time, .pg_stay_time").live("change", function() {
			change_time();
		});
		// カテゴリ選択UI設定
		$(".select-category").each(function() {
			var path = $(this).parent().find(".category_val").val();
			var current = 1;
			var node = [];
			if (path) {
				path_split = path.split("/");
				current = path_split[path_split.length - 2];
				node = [ "node_"+current ];
			}
			var jstree_option = {
				"json_data" : {
					"ajax": {
						"url": gBaseUrl + 'user/category/tree/' + current,
						"data": function(n) {
							return {
								"opration": "get_children",
								"id": n.attr ? n.attr("id").replace("node_", ""): ""
							};
						}
					}
				},
				"ui": { "initially_select": node },
				"plugins" : [ "themes", "json_data", "ui" ]
			};
			$(this).jstree(jstree_option).bind("select_node.jstree", function (e, data) {
				$(this).parent().find(".category_label").val($(this).jstree("get_path", data.rslt.obj, false).join(" > "));
				var val = "/" + $(this).jstree("get_path", data.rslt.obj, true).join("/").replace(/node_/g, "") + "/";
				$(this).parent().find(".category_val").val(val);
				$(this).hide();
			});
		});
		// カテゴリのラベルクリックで入力
		$(".category_label").click(function(e, elm) {
			var current_category = $(this).parent().find(".select-category");
			$(".select-category").not(current_category).hide("fast");
			$(current_category).css({
				"left": $(this).position().left + 25,
				"width": $(this).css("width") - 25
			}).toggle("fast");
			e.stopPropagation();
		});
		// カテゴリ選択後のイベントバブリング停止
		$(".select-category").click(function(e) {
			e.stopPropagation();
		});
		// カテゴリ入力クリア
		$(".category_clear").click(function(e){
			$(this).parent().find(".category_val, .category_label").val("");
		});
		// カテゴリ選択キャンセル 
		$(document).click(function(e) {
			$(".select-category").hide("fast");
		});
		// 時間選択
		$('#start_time').timepicker({
			'minTime': '0:00am',
			'maxTime': '12:00pm',
			'step': 30,
			'timeFormat': 'H:i'
		});
		// タグ入力補完
		$("#tags").tagit({
			itemName: "tags",
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
		// 保存ボタン
		$("#save_button").click(function() {
			var routes = [];
			$("#tour_make .list_area .tour_point").each(function(i, elm) {
				var id = $(elm).attr("data-spot-id");
				routes.push({
					id: 		id,
					stay_time:	$(elm).find(".pg_stay_time").val(),
					info:		$(elm).find(".pg_memo").val(),
					lat:		$(elm).attr("data-spot-lat"),
					lng:		$(elm).attr("data-spot-lng")
				});
			});
			if (routes.length == 0) {
				alert("ルートの指定がありません");
				return false;
			}
			var categories = [];
			$(".maincategory").each(function(i, elm) {
				categories.push($(elm).val());
			});
			$.ajax({
				url: gBaseUrl + 'user/tour/add',
				type: "post",
				data: {
					id:				$("#tour-id").val(),
					name:			$("#tour-name").val(),
					description:	$("#tour-description").val(),
					category:		categories,
					start_time:		$("#start_time").val(),
					tags:			$("#tags").tagit("assignedTags"),
					route: 			routes
				},
				dataType: "json",
				success: function(json) {
					if (json["tour_id"]) {
						location.href = gBaseUrl + 'user/top';
					}
					alert("保存しました");
				}
			});
			return false;
		});
		
		$("#pg_tour_center").click(tour_center);
		
	}

	
	mapInit();
	commonCtl.registCategoryAddSet();
	
	$("#tour_make .list_area").scroll(tourListPosi);

	/**
	 * 地図にツアー全体を表示
	 */
	function tour_center() {
		var route = [];
		var lat_min = lat_max = lng_min = lng_max = null;
		$("#tour_make .list_area .tour_point").each(function() {
			var id = $(this).attr("data-spot-id");
			if (id) {
				var lat = $(this).attr("data-spot-lat");
				var lng = $(this).attr("data-spot-lng");
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
			}
		});
		if (lat_min) {
			var ne = new google.maps.LatLng(lat_max, lng_max);
			var sw = new google.maps.LatLng(lat_min, lng_min);
			var bounds = new google.maps.LatLngBounds(sw, ne);
			map.fitBounds(bounds);
		}
		event.stopPropagation();
	}
	
	/**
	 * ルートを表示
	 */
	function show_route() {
		var route = [];
		if (linePath) {
			linePath.setMap(null);
		}
		var marker;
		var li_cnt = $("#tour_make .list_area .tour_point").length;
		$("#tour_make .list_area .tour_point").each(function(i, elm) {
			var id = $(this).attr("data-spot-id");
			if (id) {
				if (id in marker_list) {
					marker = marker_list[id]; 
				} else {
					var lat		= $(this).attr("data-spot-lat");
					var lng		= $(this).attr("data-spot-lng");
					var name	= $(this).find(".spotTitle").text();
					var desc	= $(this).find(".spotDescription").text();
					var img_src	= $(this).find(".thumbnail img").attr("src");
					marker = add_marker(id, lat, lng, name, desc, img_src, "");
				}
				if (i == 0) {
					marker.setIcon(gAssetUrl + '/img/map/icons/start.png');
				} else if(i == li_cnt - 1) {
					marker.setIcon(gAssetUrl + '/img/map/icons/finish.png');
				} else {
					marker.setIcon(gAssetUrl + '/img/map/icons/spot.png');
				}
				marker.setZIndex(9999);
				route.push(marker.getPosition());
			}
		});
		if (route.length > 1) {
			linePath = new google.maps.Polyline({
				path: route,
				clickable:		false,
				geodesic:		true,
				strokeColor:	"#009",
				strokeOpacity:	0.6,
				strokeWeight:	6
			});
			linePath.setMap(map);			
		}
	}

	/**
	 * 滞在時間で予定時刻を表示
	 */
	function change_time() {
		var start_time = $("#start_time").val();
		var times = [];
		if (!start_time) {
			times = [0, 0];
		} else {
			times = start_time.split(":");
		}
		var time = new Date();
		var total = 0;
		time.setHours(times[0]);
		time.setMinutes(times[1]);
		time.setSeconds(0);
		$("#tour_make .list_area .tour_point").each(function(i, elm) {
			$(elm).find(".pg_timecode").text($.format.date(time, "HH:mm"));
			var stay_time = $(elm).find(".pg_stay_time").val();
			total += Number(stay_time);
			time.setTime(time.getTime() + (stay_time * 60 * 1000));
		});
		$("#pg_hour").text(Math.floor(total / 60));
		$("#pg_minutes").text(total % 60);
	}
	
	/**
	 * スポット一覧検索
	 */
	function search(page) {
		if (!page) page = 1;
		if (marker_list) {
			marker_list.forEach(function(marker, idx) {
				marker.setMap(null);
			});
			marker_list = new Array();
		}
		$.ajax({
			url: gBaseUrl + "user/tour/query",
			async: false,
			data: {
				category:	$(".search_box .category dd input").val(),
				keyword:	$("#keyword").val(),
				userspot:	$("#userspot:checked").length,
//				limit:		$("#limit").val(),
				sort:		$("#sort").val(),
				page:		page,
				ne_lat:		map.getBounds().getNorthEast().lat(),
				ne_lng:		map.getBounds().getNorthEast().lng(),
				sw_lat:		map.getBounds().getSouthWest().lat(),
				sw_lng:		map.getBounds().getSouthWest().lng()
			},
			dataType: "json",
			success: function(json) {
				google.maps.event.addListener(map, "click", function(e) {
					if (current_window) {
						current_window.close();
					}
				});
				$("#spot_search .list_area .tour_point:not(.pg_spot_temp)").remove();
				$.each(json.list, function(spot_id, spot_info) {
					// テンプレートのクローン作成
					var spot_elm = $("#spot_search .pg_spot_temp")
						.clone(true)
						.removeClass("pg_spot_temp")
						.css("display", "block")
						.attr({
							"data-spot-id": spot_info.id,
							"data-spot-lat": spot_info.lat,
							"data-spot-lng": spot_info.lng,
							});
					
					if (spot_info.image) {
						spot_elm.find(".pg_image")
							.attr("src", gBaseUrl + 'uploads/spot/thumb/' + spot_info.image.file_name);
					}
					spot_elm.find(".pg_name")
						.text(spot_info.name);
					spot_elm.find(".pg_description")
						.text(spot_info.description);
					spot_elm.find(".pg_standard_time")
						.text(spot_info.stay_time);
					spot_elm.find(".detaillink a").bind("click", function() {
						spotCtl.show(gBaseUrl + 'spot/show/' + spot_info.id);
					});
					spot_elm.appendTo("#spot_search .list_area");
					
					var img_src = "";
					if (spot_info.image) {
						img_src = spot_info.image.file_name;
					}
					add_marker(spot_info.id, spot_info.lat, spot_info.lng, spot_info.name, spot_info.description, img_src, "");
				});
				
//				FB.XFBML.parse();
				
				// ドラッグ
				$("#spot_search .tour_point").draggable({
					connectToSortable: "#tour_make .list_area",
					containment: "document",
					revert: "invalid",
					helper: "clone",
					cursor: "move",
					scroll: false,
					opacity: 0.6,
					zIndex: 999,
					start: function(event, ui) {
						$("#spot_search .list_area").css("overflow", "hidden");
					},
					stop: function(event, ui) {
						$("#spot_search .list_area").css("overflow", "auto");
					}
				});

				$( "#toolSpot li" ).draggable({});
				/*
				$( "#tour_make .list_area" ).droppable({
					activeClass: "pg_jqui_state_highlight",
					hoverClass: "pg_jqui_state_hover"
				});
				*/
				/*
				// ドロップ＆ソート
				$( "#tour_make .list_area" ).droppable({
					accept: ":not(.ui-sortable-helper)",
					activeClass: "pg_jqui_state_highlight",
					hoverClass: "pg_jqui_state-hover",
					drop: function(event, ui) {
						if (ui.draggable.hasClass("memo_item")) {
							// テンプレートのクローン作成
							var add_item = $("#tour_make .pg_memo_temp")
								.clone(true)
								.removeClass("pg_spot_temp")
								.css("display", "block");
						} else {
							// テンプレートのクローン作成
							var add_item = $("#tour_make .pg_spot_temp")
								.clone(true)
								.removeClass("pg_spot_temp")
								.css("display", "block");
							add_item.find(".pg_name")
								.text(ui.draggable.find(".pg_name").text());
							add_item.find(".pg_stay_time")
								.text(ui.draggable.find(".pg_stay_time").text());
							add_item.find(".pg_image")
								.attr("src", ui.draggable.find(".pg_image").attr("src"));
							add_item.find(".detaillink a").bind("click", function() {
								spotCtl.show(gBaseUrl + 'spot/show/' + ui.draggable.attr("data-spot-id"));
							});
						}
						add_item.appendTo("#tour_make .list_area");
						
					}
				});
				*/
				$( "#tour_make .list_area" ).sortable({
					stop: function(event, ui) {
						change_time();
						show_route();
						FB.XFBML.parse();
					},
					axis: "y",
					revert: true
				});

				var start = ((page - 1) * $("#limit").val()) + 1;
				var end = page * $("#limit").val();
				if (json.count < end) {
					end = json.count;
				}
				$("#search-count").text(json.count);
				$("#start").text(start);
				$("#end").text(end);
				var page_count = Math.ceil(json.count / $("#limit").val());
				
				pager(page_count, page);
				show_route();
			}
		});
	}
	
	function add_marker(id, lat, lng, name, description, image, icon) {
		var latlng = new google.maps.LatLng(lat, lng);
		var marker = new google.maps.Marker({
			icon : gAssetUrl + "img/map/marker.png",
			shadow: gAssetUrl + "img/map/shadow.png",
			map			: map,
			position	: latlng,
			title		: name,
			draggable	: false
		});
		google.maps.event.addListener(marker, "click", function() {
			info_window(id);
			if (current_window) {
				current_window.close();
			}
			var content = "";
			if (image) {
				content += '<img style="float:left;" src="' + gBaseUrl + 'uploads/spot/thumb/' + image + '" width="60" height="60" alt="" />';
			}
			content += "<b>" + name + "</b><br />" + description;
			var infowindow = new google.maps.InfoWindow({
				content: content
			});
			infowindow.open(map, marker);
			current_window = infowindow;
		});
		marker_list[id] = marker;
		return marker;
	}
	
	function info_window(id) {
		close_info_window(current_window_id);
		var target = '#spot_search [data-spot-id="' + id + '"]';
		$(target).each(function(i, spot) {
			$("#spot_search .list_area")
				.animate({scrollTop: $("#spot_search .list_area").scrollTop() + $(spot).position().top}, "first");
			$(spot).addClass("active");
//				.css("background-color", "#000");
		});
		current_window_id = id;
	}
	
	function close_info_window(id) {
		if (current_window_id) {
			var target = '[data-spot-id="' + current_window_id + '"]';
			$(target).each(function(i, spot) {
				$(spot).removeClass("active");
//					.css({ background: "#fff"});
			});
		}
	}

	/**
	 * スポット一覧のページネーション
	 */
	function pager(page_count, now) {
		if (page_count > 0) {
			$("#pagenation").show();
			$("#pagenation").paginate({
				count					: page_count,
				start					: now,
				display					: 5,
				border					: true,
				border_color			: false,
				text_color  			: false,
				background_color    	: false,
				border_hover_color		: false,
				text_hover_color  		: false,
				background_hover_color	: false,
				images					: false,
				mouse					: 'press',
				onChange				: function(page) {
					search(page);
				}
			});
		} else {
			$("#pagenation").hide();
		}
	}
	
	function tourListPosi(){
		if($("#tour_make .list_area").scrollTop()>10){
			$("#tour_make .starttime").stop().animate({opacity:0},200);
		}else{
			$("#tour_make .starttime").stop().animate({opacity:1},200);
		}
	}
	
	//block高さ調整
	function blockHeightAdjust(){
		var spotSearch=$("#spot_search");
		var tourMake=$("#tour_make");
		setInterval(heightAdjust,200);
		function heightAdjust(){
			var targetHeight=$("#basic_area").height();
			spotSearch.find(".list_area").css("height",targetHeight-spotSearch.find(".search_box").height()-spotSearch.find(".search_info").height()-spotSearch.find(".memo_item").height()-150+"px");
			tourMake.find(".list_area").css("height",targetHeight-283+"px");
			$("#joint span").css("height",spotSearch.find(".search_box").height()+39+"px");
		}
	}
	blockHeightAdjust();
};