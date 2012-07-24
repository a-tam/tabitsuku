var page_count = 1;
$(document).ready(function () {

	get_list(1);
	
	$(document).click(function(e) {
		$(".select-category").hide("fast");
	});
	
	$(".category_label").click(function(e, elm) {
		$(this).parent().find(".select-category")
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
	
	function get_list(page) {
		$.ajax({
			url: gBaseUrl + "api/tour",
			data: {
				type: "mydata",
				limit: $("#pg_search_limit").val(),
				page: page,
				category: $("#pg_search_category").val(),
				keyword: $("#pg_search_keyword").val(),
			},
			dataType: "json",
			success: function(json) {
				page_count = Math.ceil(json["count"] / $("#pg_search_limit").val());
				pager(page_count, page);
				if (json["count"] > 0) {
					$(".pg_tour").not("#pg_tour_temp").fadeOut("first", function() {
						$(this).remove();
					});
					show_list(json);
				}
			}
		});
	}
	
	function show_list(json) {
		$.each(json["list"], function(tour_id, tour_info) {
			var tour = $("#pg_tour_temp").clone(true).attr("id", "");
			tour.css("display", "block");
			
			tour.find(".pg_title")
				.text(tour_info.name);
			
			tour.find(".pg_like_count")
				.addClass("fb-like")
				.attr("data-href", gBaseUrl + 'user/tour/show/' + tour_info.id);
			
			if (tour.image) {
				tour.find(".pg_img img")
					.attr("src", gBaseUrl + "uploads/tour/thumb/" + tour.image.file_name);
			}
			
			tour.find(".pg_description").text(tour_info.description);
			
			tour.find(".pg_category").empty();
			var category_name = [];
			$(tour_info.category.match(/\d+/g)).each(function(i, category_id) {
				category_name.push(json["relation"]["categories"][category_id]);
			});
			tour.find(".pg_category").append("<li>" + category_name.join(" > ") + "</li>");

			tour.find(".pg_tags").empty();
			$(tour_info.tags.match(/\d+/g)).each(function(i, tag_id) {
				tour.find(".pg_tags").append("<li>" + json["relation"]["tags"][tag_id] + "</li>");
			});
			
			tour.find(".pg_routes").empty();
			$(this.routes).each(function(i, route) {
				tour.find(".pg_routes").append("<li>" + route.name + " (" + route.stay_time + "分)</li>");
			});

			tour.find(".pg_copy a")
				.attr("href", gBaseUrl + 'user/tour/copy/' + tour_info.id);
			
			tour.appendTo("#pg_tours");
		});
	}
	
	function pager(page_count, now) {
		$("#pagenation").paginate({
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
				get_list(page);
			}
		});
	}

});