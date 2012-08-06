$(function() {
	var map;

	show_spot();
	show_tour();

	var tabIndexs = {'pg_tabs_spot' : 0, 'pg_tabs_tour' : 1};
	var tab_index = tabIndexs[window.location.hash.slice(3)];
	tab_index = tab_index ? tab_index : 0;
	
	$( "#pg_tabs" ).tabs({
		selected: tab_index,
		show: function(event, ui){
			if (ui.index == 0) {
				load_map(ui.panel.id, -34.397, 150.644, 8);
			} else if (ui.index==1) {
				load_map(ui.panel.id, 34.397, 135.644, 8);
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

	function load_map(placeholder, lat, lng, z) {
		if (!google) {
			return false;
		}
		var myOptions = {
				zoom: z,
				center: new google.maps.LatLng(lat, lng),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
		map = new google.maps.Map($("#"+placeholder).find(".pg_map")[0], myOptions);
	}
	
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
	function show_spot() {
		$.ajax({
			url: gBaseUrl + "api/spot",
			data: {
				owner: "mydata"
			},
			dataType: "json",
			success: function(json) {
				if (json["count"] > 0) {
					$.each(json["list"], function(spot_id, spot_info) {
						var spot_elm = $("#pg_spot_temp").clone(true).attr("id", "");
						spot_elm.css("display", "block");

						spot_elm.find(".pg_name")
							.text(spot_info.name);

						if (spot_info.image) {
							spot_elm.find(".pg_image")
								.attr("src", gBaseUrl + "uploads/spot/thumb/" + spot_info.image.file_name);
						}

						spot_elm.find(".pg_stay_time")
							.text(spot_info.stay_time + "分");

						spot_elm.find(".pg_category").empty();
						$(spot_info.category.split(",")).each(function(i, category) {
							var category_name = [];
							$(category.match(/\d+/g)).each(function(i, category_id) {
								category_name.push(json["relation"]["categories"][category_id]);
							});
							spot_elm.find(".pg_category").append("<li>" + category_name.join(" > ") + "</li>");
						});

						spot_elm.find(".pg_description").text(spot_info.description);

						spot_elm.find(".pg_tags").empty();
						$(spot_info.tags.match(/\d+/g)).each(function(i, tag_id) {
							spot_elm.find(".pg_tags").append("<li>" + json["relation"]["tags"][tag_id] + "</li>");
						});
						
						spot_elm.find(".pg_detail").attr("href", gBaseUrl + "spot/show/" + spot_info.id);
						spot_elm.find(".pg_edit").attr("href", gBaseUrl + "user/spot/form/" + spot_info.id);
						spot_elm.find(".pg_delete").attr("href", gBaseUrl + "user/spot/delete/" + spot_info.id);
						
						spot_elm.appendTo("#pg_spots");
					});
				}
			}
		});
	}
	
	/**
	 * ツアー一覧表示
	 */
	function show_tour() {
		$.ajax({
			url: gBaseUrl + "api/tour",
			data: {
				owner: "mydata",
			},
			dataType: "json",
			success: function(json) {
				if (json["count"] > 0) {
					$.each(json["list"], function(tour_id, tour_info) {
						var tour_elm = $("#pg_tour_temp").clone(true).attr("id", "");
						tour_elm.css("display", "block");
						
						tour_elm.find(".pg_name")
							.text(tour_info.name);
						
						tour_elm.find(".pg_like_count")
							.addClass("fb-like")
							.attr("data-href", gBaseUrl + 'user/tour/show/' + tour_info.id);
						
						if (tour_info.image) {
							tour_elm.find(".pg_image")
								.attr("src", gBaseUrl + "uploads/tour/thumb/" + tour_info.image.file_name);
						}

						var stay_time = 0;
						$(this.routes).each(function(i, route) {
							stay_time += (route.stay_time * 1);
						});
						tour_elm.find(".pg_stay_time")
						.text(stay_time + "分");

						tour_elm.find(".pg_description").text(tour_info.description);
						
						tour_elm.find(".pg_category").empty();
						var category_name = [];
						$(tour_info.category.match(/\d+/g)).each(function(i, category_id) {
							category_name.push(json["relation"]["categories"][category_id]);
						});
						tour_elm.find(".pg_category").append("<li>" + category_name.join(" > ") + "</li>");

						tour_elm.find(".pg_tags").empty();
						$(tour_info.tags.match(/\d+/g)).each(function(i, tag_id) {
							tour_elm.find(".pg_tags").append("<li>" + json["relation"]["tags"][tag_id] + "</li>");
						});
						
						tour_elm.find(".pg_detail")
							.attr("href", gBaseUrl + "tour/show/" + tour_info.id);
						tour_elm.find(".pg_copy")
							.attr("href", gBaseUrl + 'user/tour/copy/' + tour_info.id);
						tour_elm.find(".pg_edit")
							.attr("href", gBaseUrl + "user/tour/form/" + tour_info.id);
						tour_elm.find(".pg_delete")
							.attr("href", gBaseUrl + "user/tour/delete/" + tour_info.id);
						
						tour_elm.appendTo("#pg_tours");
					});
				}
			}
		});
	}
	
});