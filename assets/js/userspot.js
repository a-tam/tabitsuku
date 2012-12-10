(function() {
	
	var map;
	var spot_current_window;
	var spot_marker_list = {};
	var spot_path_list = {};
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
					show_spot(1);
				}
			});
			google.maps.event.addListener(map, 'zoom_changed', function() {
				if ($("#pg_search_map_select").val() == "1") {
					show_spot(1);
				}
			});
			google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
				show_spot(1);
			});

		}

	
		/**
		 * ツアー一覧表示
		 */
		function show_spot(page) {
			var limit = $("#pg_search_page_number").val();
			if (!limit) limit = 10;
			var request = {
					owner		: $("#pg_search_owner").val(),
					category	: $("#pg_search_category").val(),
					keyword		: $("#pg_search_keyword").val(),
					limit		: limit,
					sort		: $("#pg_search_order").val(),
					page		: page
			};
			
			if ($("#pg_search_map_select").val() == "1") {
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
					// テンプレートを除くリストクリア
					$("#pg_spots .list_item:not(.pg_spot_temp)").remove();
					$.each(spot_marker_list, function(spot_id, marker) {
						marker.setMap(null);
					});
					if (json["count"] > 0) {
						$(".search_count").text(json["count"]);
						page_count = Math.ceil(json["count"] / limit);
						pager(page_count, page);
						// 
						google.maps.event.addListener(map, "click", function(e) {
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
							// いいねボタン
							spot_elm.find(".pg_like_count")
								.addClass("fb-like")
								.attr("data-href", gBaseUrl + 'user/tour/show/' + spot_info.id);
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
								spot_elm.find(".pg_category").append('<dt><img src="' + gAssetUrl + '/img/common/icon/category.gif" alt="CATEGORY" /></dt><dd>' + category_name.join(" > ") + '</dd>');
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
							if (spot_info.mydata) {
								spot_elm.find(".pg_edit")
									.attr("href", gBaseUrl + "user/spot/form/" + spot_info.id);
								spot_elm.find(".pg_delete")
									.attr("href", gBaseUrl + "user/spot/delete/" + spot_info.id);
							} else {
								spot_elm.find(".pg_edit").remove();
								spot_elm.find(".pg_delete").remove();
							}
							spot_elm.appendTo("#pg_spots");
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
								infowindow.open(map);
								spot_current_window = infowindow;
							});
							spot_marker_list[spot_info.id] = marker;
						});
					}
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
	}

})();