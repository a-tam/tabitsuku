var map = null;

$(document).ready(function () {

	var current_window = null;
	var marker_list = new Array();
	var info_list = new Array();
	var latlng = {};
	var myOptions = {};
	var linePath = null;
	
	// 初期処理
	initialize();
	function initialize() {
		// 全体レイアウト
		$('#container').layout({
			east__paneSelector	: ".ui-layout-east" ,
			east__size			: 310,
			enableCursorHotkey	: false,
			closable			: false,
			resizable			: false
		});
		// 地図・スポットレイアウト
		centerLayout = $('div.ui-layout-center').layout({
			minSize				: 100 ,	// ALL panes
			center__paneSelector: ".center-center" ,
			east__paneSelector	: ".center-east" ,
			east__size			: 300,
			enableCursorHotkey	: false,
			closable			: false,
			resizable			: false
		});
		// スポット検索レイアウト
		centerLayout = $('div.center-center').layout({
			center__paneSelector: ".ui-layout-center" ,
			north__paneSelector	: ".ui-layout-north" ,
			north__size			: 45,
			enableCursorHotkey	: false,
			closable			: false,
			resizable			: false
		});
		// スポットレイアウト
		spotLayout = $('div.center-east').layout({
			center__paneSelector: ".ui-layout-center",
			north__paneSelector	: ".ui-layout-north",
			north__size			: 152,
			south__paneSelector	: ".ui-layout-south",
			south__size			: 100,
			enableCursorHotkey	: false,
			closable			: false,
			resizable			: false
		});
		// ツアーレイアウト
		spotLayout = $('div.ui-layout-east').layout({
			center__paneSelector: ".ui-layout-center",
			north__paneSelector	: ".ui-layout-north",
			north__size			: 30,
			south__paneSelector	: ".ui-layout-south",
			south__size			: 250,
			enableCursorHotkey	: false,
			closable			: false,
			resizable			: false
		});
		// 地図表示
		latlng = new google.maps.LatLng(35.6894875, 139.69170639999993);
		myOptions = {
			zoom		: 10,
			center		: latlng,
			mapTypeId	: google.maps.MapTypeId.ROADMAP
		};
		map = new google.maps.Map(document.getElementById("mapArea"), myOptions);
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
			setPosition(place.geometry.location);
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
			//search();
		});
		$("#search").click(function() {
			search();
		});
		$("#spotFilterButton").click(function() {
			search();
		});
		// 予定時刻を反映
		change_time();
		// ツアーにスポット追加
		$(".iconAdd").live("click", function() {
			var self = $(this).closest(".spot");
			self.clone().hide().appendTo($("#tourAreaFrameScroll .spotList")).fadeIn("slow");
			change_time();
			return false;
		});
		// ツアーにスポット解除
		$(".iconClose").live("click", function() {
			$(this).closest(".spot").fadeOut(300).queue(function(){ $(this).remove();});
			change_time();
			return false;
		});
		// 予定のスポットを入れ替え（上）
		$(".iconUp").live("click", function() {
			var self = $(this).closest(".spot");
			self.insertBefore(self.prev());
			change_time();
			return false;
		});
		// 予定のスポットを入れ替え（下）
		$(".iconDown").live("click", function() {
			var self = $(this).closest(".spot");
			self.insertAfter(self.next());
			change_time();
			return false;
		});
		// スポットのソート、滞在時間変更で予定時刻を変更
		$("#start_time, .stay_time").live("change", function() {
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
		// timepickerのz-indexを変更しても反映されない。ツアーリストのz-indexを無理やり変更しているので後で編集する
		$("#tourAreaFrameScroll").css("zIndex", 1);
		$("#spotAreaFrameScroll").css("zIndex", 1);
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
		$("#headerSaveArea").click(function() {
			var routes = [];
			$("#tourAreaFrameScroll .spotList li").each(function(i, elm) {
				var id = $(elm).attr("data-spot-id");
				routes.push({
					id: 		id,
					stay_time:	$(elm).find(".stay_time").val(),
					info:		$(elm).find(".spot_info").val(),
					lat:		$(elm).attr("data-spot-lat"),
					lng:		$(elm).attr("data-spot-lng")
				});
			});
			if (routes.length == 0) {
				alert("ルートの指定がありません");
				return false;
			}
			$.ajax({
				url: gBaseUrl + 'user/tour/add',
				type: "post",
				data: {
					id:				$("#guide-id").val(),
					name:			$("#guide-name").val(),
					description:	$("#guide-description").val(),
					category:		$("#category").val(),
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
		
		// lightbox設置
		$(".various").fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: false,
			closeClick	: false,
			openEffect : 'elastic',
			openSpeed  : 150,

			closeEffect : 'elastic',
			closeSpeed  : 150,

			closeClick : true,
			helpers : {
				title : {
					type : 'inside'
				},
				overlay : {
					opacity : 0.5
				}
			}
		});
		
		$("#pg_tour_center").click(tour_center);
	}
	
	/**
	 * 地図にツアー全体を表示
	 */
	function tour_center() {
		var route = [];
		var lat_min = lat_max = lng_min = lng_max = null;
		$("#tourAreaFrameScroll .spotList li").each(function() {
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
		var li_cnt = $("#tourAreaFrameScroll .spotList li").length;
		$("#tourAreaFrameScroll .spotList li").each(function(i, elm) {
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
		var time = new Date();
		var times = start_time.split(":");
		time.setHours(times[0]);
		time.setMinutes(times[1]);
		time.setSeconds(0);
		$("#tourAreaFrameScroll .timecode").text(start_time);
		$("#tourAreaFrameScroll .spotList li").each(function(i, elm) {
			var stay_time = $(elm).find(".stay_time").val();
			time.setTime(time.getTime() + (stay_time * 60 * 1000));
			$(elm).find(".timecode").text($.format.date(time, "HH:mm"));
		});
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
				category:	$("#search-category").val(),
				keyword:	$("#keyword").val(),
				limit:		$("#limit").val(),
				sort:		$("#sort").val(),
				page:		page,
				ne_lat:		map.getBounds().getNorthEast().lat(),
				ne_lng:		map.getBounds().getNorthEast().lng(),
				sw_lat:		map.getBounds().getSouthWest().lat(),
				sw_lng:		map.getBounds().getSouthWest().lng()
			},
			dataType: "json",
			success: function(json) {
				$("#spotAreaFrameScroll").html("");
				$.each(json.list, function(spot_id, spot_info) {
					var html = '<li data-spot-id="' + spot_info.id + '" class="spot" data-spot-lat="' + spot_info.lat +'" data-spot-lng="' + spot_info.lng + '" >' +
						'<div class="spotArea">' +
						'<div class="spotDetail">' +
						'<div class="thumbnail">';
						if (spot_info.image) {
							html += '<img src="' + gBaseUrl + 'uploads/spot/thumb/' + spot_info.image.file_name + '" width="60" height="60" alt="" />';
						}
						html += '</div>' +
						'<div class="textArea">' +
						'<p class="spotTitle">'+spot_info.name+'</p>' +
						'<p class="spotDescription">'+spot_info.description+'</p>' +
						'<div class="timePullDown">' +
						'滞在時間' +
						'<select name="stay_time" class="stay_time">';
						var step = 15;
						for (i = 1; i <= 24; i++) {
							stay_time = i * step;
							disp_stay_time = new Date(0, 1, 1, 0, stay_time, 0);
							html += '<option value="' + stay_time + '">' + $.format.date(disp_stay_time, "HH:mm") + '</option>';
						}
						html += '</select>' +
						'</div>' +
						'</div>' +
						'<div class="spotBtnArea clearfix">' +
						'<span class="bntDetail"><a class="various fancybox.ajax" href="' + gBaseUrl + 'spot/show/' + spot_info.id + '">詳細をみる</a></span>' +
						'<div class="fb-like" data-href="' + gBaseUrl + 'spot/show/' + spot_info.id + '" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false">' +
						'</div>' +
						'</div>' +
						'</div>' +
						'<div class="naviArea">' +
						'<div class="iconAdd">' +
						'<img src="' + gAssetUrl + 'img/interface/icon/add16.png" width="16" height="16" alt="add">' +
						'</div>' +
						'<div class="iconUp">' +
						'<img src="' + gAssetUrl + 'img/interface/icon/up16.png" width="16" height="16" alt="up">' +
						'</div>' +
						'<div class="iconClose">' +
						'<img src="' + gAssetUrl + 'img/interface/icon/close16.png" width="16" height="16" alt="add">' +
						'</div>' +
						'<div class="iconDown">' +
						'<img src="' + gAssetUrl + 'img/interface/icon/down16.png" width="16" height="16" alt="add">' +
						'</div>' +
						'</div>' +
						'</div>' +
						'<span class="timecode">9:00</span>' +
						'</li>';

					$("#spotAreaFrameScroll").append(html);
					var img_src = "";
					if (spot_info.image) {
						img_src = spot_info.image.file_name;
					}
					add_marker(spot_info.id, spot_info.lat, spot_info.lng, spot_info.name, spot_info.description, img_src, "");
				});
				
				FB.XFBML.parse();
				
				$(".add_tour").click(function() {
					alert(1);
				});
				
				$( "#spotAreaFrameScroll li" ).draggable({
					connectToSortable: "#tourAreaFrameScroll ul",
					containment: "document",
					revert: "invalid",
					helper: "clone",
					delay: 100,
					cursor: "move",
					scroll: false,
					opacity: 0.6,
//					handle: ".spotTitle",
					start: function(event, ui) {
						$("#spotAreaFrameScroll").css("overflow-y", "visible");
					},
					stop: function(event, ui) {
						$("#spotAreaFrameScroll").css("overflow-y", "auto");
					}
				});
				
				$( "#toolSpot li" ).draggable({
					connectToSortable: "#tourAreaFrameScroll ul",
					containment: "document",
					revert: "invalid",
					helper: "clone",
					delay: 100,
					cursor: "move",
					scroll: false,
					opacity: 0.6,
//					handle: ".spotTitle",
				});

				$( ".spotList li" ).bind("click", function() {
					var spot_id = $(this).attr("data-spot-id");
					if (spot_id in marker_list) {
						google.maps.event.trigger(marker_list[spot_id], 'click');
					}
				});

				$( "#spotAreaFrameScroll li, #toolSpot li" ).bind("mouseleave", function() {
					//console.log($(this).attr("data-spot-id"));
				});

				
				$( "#tourAreaFrameScroll ul" ).droppable({
					accept: "#spotAreaFrameScroll li",
					activeClass: "pg_jqui_state_highlight",
					hoverClass: "pg_jqui_state-hover",
				});
				
				$( "#tourAreaFrameScroll ul" ).sortable({
					stop: function(event, ui) {
						change_time();
						show_route();
						FB.XFBML.parse();
					},
					axis: "y",
					delay: 100,
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
			map			: map,
			position	: latlng,
			title		: name,
			draggable	: false
		});
		google.maps.event.addListener(marker, "click", function() {
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

	/**
	 * スポット一覧のページネーション
	 */
	function pager(page_count, now) {
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
	}
});
