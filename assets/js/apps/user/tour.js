var map = null;

$(document).ready(function () {

	change_time();
	// ツアー作成
	$('#container').layout({
		east__paneSelector:	".ui-layout-east" ,
		east__size: 310,
		enableCursorHotkey: false,
		closable: false,
		resizable: false
	});
	// 地図・スポット
	centerLayout = $('div.ui-layout-center').layout({
		minSize: 100 ,	// ALL panes
		center__paneSelector:	".center-center" ,
		east__paneSelector:	".center-east" ,
		east__size: 300,
		enableCursorHotkey: false,
		closable: false,
		resizable: false
	});
	// スポット検索
	centerLayout = $('div.center-center').layout({
		center__paneSelector:	".ui-layout-center" ,
		north__paneSelector:	".ui-layout-north" ,
		north__size: 35
	});
	// スポットレイアウト
	spotLayout = $('div.center-east').layout({
		center__paneSelector:	".ui-layout-center"
		,north__paneSelector:	".ui-layout-north"
		,north__size: 130
		,south__paneSelector:	".ui-layout-south"
		,south__size: 100
	});
	// ツアーレイアウト
	spotLayout = $('div.ui-layout-east').layout({
		center__paneSelector:	".ui-layout-center"
		,north__paneSelector:	".ui-layout-north"
		,north__size: 60
		,south__paneSelector:	".ui-layout-south"
		,south__size: 230
	});

	var latlng = new google.maps.LatLng(35.6894875, 139.69170639999993);
	var myOptions = {
		zoom: 10,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("mapArea"), myOptions);
	var marker_list = new Array();
	var info_list = new Array();

	// 移動
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
//		infowindow = new google.maps.InfoWindow();
//		service = new google.maps.places.PlacesService(map);
//		service.search(request, callback);
		// 検索結果の中央座標設定
		setPosition(place.geometry.location);
	});
	
	google.maps.event.addListener(map, 'dragend', function() {
	    setTimeout(search, 300);
	  });

	google.maps.event.addListener(map, 'zoom_changed', function() {
	    setTimeout(search, 300);
	  });

	google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
	    setTimeout(search, 300);
	});
	
	$("#search").click(function() {
		search();
		return false;
	});

	$("#category,#keyword,#season,#limit,#sort").change(function() {
		search();
	});

	$("#spotFilterButton").click(function() {
		search();
	});

	$("#start_time, .stay_time").live("change", function() {
		change_time();
	});

	$(".iconAdd").live("click", function() {
		var self = $(this).closest(".spot");
		self.clone().hide().appendTo($("#tourAreaFrameScroll .spotList")).fadeIn("slow");
		change_time();
		return false;
	});
	
	$(".iconClose").live("click", function() {
		$(this).closest(".spot").fadeOut(300).queue(function(){ $(this).remove();});
		change_time();
		return false;
	});
	
	$(".iconUp").live("click", function() {
		var self = $(this).closest(".spot");
		self.insertBefore(self.prev());
		change_time();
		return false;
	});
	
	$(".iconDown").live("click", function() {
		var self = $(this).closest(".spot");
		self.insertAfter(self.next());
		change_time();
		return false;
	});
	
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
	
	function search(page) {
		if (!page) page = 1;
		if (marker_list) {
			marker_list.forEach(function(marker, idx) {
				marker.setMap(null);
			});
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
				ne_x:		map.getBounds().getNorthEast().lat(),
				ne_y:		map.getBounds().getNorthEast().lng(),
				sw_x:		map.getBounds().getSouthWest().lat(),
				sw_y:		map.getBounds().getSouthWest().lng()
			},
			dataType: "json",
			success: function(json) {
				$("#spotAreaFrameScroll").html("");
				$(json.list).each(function() {
					var html = '<li data-spot-id="'+this.id+'" class="spot">' +
						'<div class="spotArea">' +
						'<div class="spotDetail">' +
						'<div class="thumbnail">';
						if (this.image) {
							html += '<img src="' + gBaseUrl + 'uploads/spot/thumb/' + this.image.file_name + '" width="60" height="60" alt="" />';
						}
						html += '</div>' +
						'<div class="textArea">' +
						'<p class="spotTitle">'+this.name+'</p>' +
						'<p class="spotDescription">'+this.description+'</p>' +
						'<div class="timePullDown">' +
						'滞在時間' +
						'<select name="stay_time" class="stay_time">' +
						'<option value="15">15分</option>' +
						'<option value="30">30分</option>' +
						'<option value="45">45分</option>' +
						'</select>' +
						'</div>' +
						'</div>' +
						'<div class="spotBtnArea clearfix">' +
						'<span class="bntDetail"><a href="' + gBaseUrl + 'user/spot/show/' + this.id + '">詳細をみる</a></span>' +
						'<div class="fb-like" data-href="' + gBaseUrl + 'user/spot/show/' + this.id + '" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false">' +
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
					/*
					var html = '<li class="spot" data-spot-id="'+this.id+'">' +
					'<p class="spotTitle">'+this.name+'&nbsp;<span class="spot_tools">' +
					'<a class="spot_add">[追加]</a>' +
					'<a class="spot_up" style="visibility:false; display:none;">↑</a>' +
					'<a class="spot_down" style="visibility:false; display:none;">↓</a>' +
					'<a class="spot_delete" style="visibility:false; display:none;">[削除]</a>' +
					'</span></p>' +
					'<div class="min60">';
					if (this.image) {
						html += '<img src="' + gBaseUrl + '/uploads/spot/thumb/' + this.image.file_name + '" width="110" height="81" alt="写真" class="spotPhoto">';
					}
					html += '<p class="spotDescription">'+this.description+'</p>' +
					'</div>' +
					'<div class="spotBtnArea">滞在時間：60分 <a href="#">詳細を見る</a></div>' +
					'<div class="facebook_like_button" id="'+this.id+'"></div>' +
					'</li>';
					*/

					$("#spotAreaFrameScroll").append(html);
					var latlng = new google.maps.LatLng(this.x, this.y);
					var marker = new google.maps.Marker({
						map: map,
						position: latlng,
						title: this.name,
						draggable: false
					});
					marker_list[this.id] = marker;
					info_list[this.id] = new google.maps.InfoWindow({
						content: this.description,
						position: latlng
					});
				});
				
				FB.XFBML.parse();
				
				$(".add_tour").click(function() {
					alert(1);
				});

				$( "#spotAreaFrameScroll li, #toolSpot li" ).draggable({
					connectToSortable: "#tourAreaFrameScroll ul",
					containment: "document",
					revert: "invalid",
					helper: "clone",
					delay: 100,
//					cursor: "move",
					scroll: false,
					opacity: 0.8
//					handle: ".spotTitle"
				});

				$( "#tourAreaFrameScroll ul" ).droppable({
					accept: "",
					activeClass: "ui-state-highlight",
					drop: function(event, ui) {
						console.log(1111);
					}
				});
				
				$( "#tourAreaFrameScroll ul" ).sortable({
					stop: function(event, ui) {
						change_time();
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
			}
		});
	}

	function infoWindowOpen(id) {
		$.each(kmlInfoWindow, function(index, infoWindow_) {
			if (id == index) {
				infoWindow_.open(map);
			} else {
				infoWindow_.close(map);
			}
		});
	};
	
	function pager(page_count, now) {
		$("#pagenation").paginate({
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

	$(document).click(function(e) {
		$(".select-category").hide("fast");
	});

	$(".category_label").click(function(e, elm) {
		$(".select-category").not($(this).next()).hide("fast");
		$(this).next()
		.css({
			"left": $(this).position().left + 25,
			"width": $(this).css("width") - 25
			})
		.toggle("fast");
		e.stopPropagation();
	});

	$(".select-category").click(function(e) {
		e.stopPropagation();
	});

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
	
	$("#headerSaveArea").click(function() {
		var routes = [];
		$("#tourAreaFrameScroll .spotList li").each(function(i, elm) {
			var id = $(elm).attr("data-spot-id");
			routes.push({
				id: 		id,
				stay_time:	$(elm).find(".stay_time").val(),
				info:		$(elm).find(".spot_info").val()
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
				console.log(routes);
			}
		});
		return false;
	});
});
