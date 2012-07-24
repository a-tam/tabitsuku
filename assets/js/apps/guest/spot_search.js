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
			url: gBaseUrl + "api/spot",
			data: {
				type: "mydata",
				limit: $("#pg_search_limit").val(),
				page: page,
				category: $("#pg_search_category").val(),
				keyword: $("#pg_search_keyword").val(),
			},
			dataType: "json",
			success: function(json) {
				if (json["count"] > 0) {
					page_count = Math.ceil(json["count"] / $("#pg_search_limit").val());
					pager(page_count, page);
					$(".pg_spot").not("#pg_spot_temp").fadeOut("fast", function() {
						$(this).remove();
					});
					show_list(json);
				}
			}
		});
	}
	
	function show_list(json) {
		$.each(json["list"], function(spot_id, spot_info) {
			var spot = $("#pg_spot_temp").clone(true).attr("id", "");
			spot.css("display", "block");
			
			if (spot_info.image) {
				spot.find(".pg_img img")
					.attr("src", gBaseUrl + "uploads/spot/thumb/" + spot_info.image.file_name);
			}
			
			spot.find(".pg_name")
				.text(spot_info.name);
			
			spot.find(".pg_like_count")
				.addClass("fb-like")
				.attr("data-href", gBaseUrl + 'user/tour/show/' + spot_info.id);
		
			spot.find(".pg_stay_time")
				.text(spot_info.stay_time + "分");
			
			spot.find(".pg_category").empty();
			$(spot_info.category.split(",")).each(function(i, category) {
				var category_name = [];
				$(category.match(/\d+/g)).each(function(i, category_id) {
					category_name.push(json["relation"]["categories"][category_id]);
				});
				spot.find(".pg_category").append("<li>" + category_name.join(" > ") + "</li>");
			});

			spot.find(".pg_description").text(spot_info.description);

			spot.find(".pg_tags").empty();
			$(spot_info.tags.match(/\d+/g)).each(function(i, tag_id) {
				spot.find(".pg_tags").append("<li>" + json["relation"]["tags"][tag_id] + "</li>");
			});
			spot.appendTo("#pg_spots");
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