var page_count = 1;
$(document).ready(function () {

	get_list(1);
	
	function get_list(page) {
		// var limit = $("#pg_search_limit").val(); 
		var limit = 10;
		$.ajax({
			url: gBaseUrl + "api/spot",
			data: {
				type		: "",
				limit		: limit,
				page		: page,
				category	: $(".search_box .category dd input").val(),
				keyword		: $("#pg_search_keyword").val(),
			},
			dataType: "json",
			success: function(json) {
				$(".search_count").text(json["count"]);
				page_count = Math.ceil(json["count"] / limit);
				pager(page_count, page);
				if (json["count"] > 0) {
					show_list(json);
				}
			}
		});
	}
	
	function show_list(json) {
		$(".list_item:not(.pg_temp)").remove();
		$.each(json["list"], function(id, item) {
			var elm = $(".pg_temp").clone(true).attr("id", "");
			elm.attr("data-id", item.id);
			elm.removeClass("pg_temp");
			elm.css("display", "block");
			
			elm.find(".pg_name")
				.text(item.name);

			elm.find(".pg_description")
				.text(item.description);

			if (item.image) {
				elm.find(".pg_img img")
					.attr("src", gBaseUrl + "uploads/spot/thumb/" + item.image.file_name);
			}
			
			elm.find(".pg_like_count")
				.addClass("fb-like")
				.attr("data-href", gBaseUrl + 'tour/show/' + item.id);
		
			elm.find(".pg_detail a").attr("href", gBaseUrl + 'spot/show/' + item.id)

			elm.find(".pg_stay_time")
				.text(item.stay_time + "分");
			
			elm.find(".pg_category").empty();
			$(item.category.split(",")).each(function(i, category) {
				var category_name = [];
				$(category.match(/\d+/g)).each(function(i, category_id) {
					category_name.push(json["relation"]["categories"][category_id]);
				});
				elm.find(".pg_category").append("<li>" + category_name.join(" > ") + "</li>");
			});

			
			elm.find(".pg_tags").empty();
			$(item.tags.match(/\d+/g)).each(function(i, tag_id) {
				elm.find(".pg_tags").append("<li>" + json["relation"]["tags"][tag_id] + "</li>");
			});
			elm.appendTo(".list_area");
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
				get_list(page);
			}
		});
	}
});