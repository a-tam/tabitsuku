var page_count = 1;
$(document).ready(function () {

	get_tour();
	get_spot();
	
	function get_tour() {
		$.ajax({
			url: gBaseUrl + "api/tour",
			data: {
				type: "mydata",
				limit: 3,
				page: 1,
				category: $("#pg_search_category").val(),
				keyword: $("#pg_search_keyword").val(),
			},
			dataType: "json",
			success: function(json) {
				if (json["count"] > 0) {
					$(".pg_tour").not("#pg_tour_temp").fadeOut("first", function() {
						$(this).remove();
					});
					show_tour(json);
				}
			}
		});
	}
	
	function show_tour(json) {
		$.each(json["list"], function(tour_id, tour_info) {
			var tour_elm = $("#pg_tour_temp").clone(true).attr("id", "");
			tour_elm.css("display", "block");
			
			tour_elm.find(".pg_title")
				.text(tour_info.name);
			
			tour_elm.find(".pg_like_count")
				.addClass("fb-like")
				.attr("data-href", gBaseUrl + 'user/tour/show/' + tour_info.id);
			
			if (tour_info.image) {
				tour_elm.find(".pg_img img")
					.attr("src", gBaseUrl + "uploads/tour/thumb/" + tour_info.image.file_name);
			}
			
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
			
			tour_elm.find(".pg_routes").empty();
			$(this.routes).each(function(i, route) {
				tour_elm.find(".pg_routes").append("<li>" + route.name + " (" + route.stay_time + "分)</li>");
			});

			tour_elm.find(".pg_copy a")
				.attr("href", gBaseUrl + 'user/tour/copy/' + tour_info.id);
			
			tour_elm.appendTo("#pg_tours");
		});
	}

	function get_spot() {
		$.ajax({
			url: gBaseUrl + "api/spot",
			data: {
				type: "mydata",
				limit: 10,
				page: 1,
				category: $("#pg_search_category").val(),
				keyword: $("#pg_search_keyword").val(),
			},
			dataType: "json",
			success: function(json) {
				if (json["count"] > 0) {
					$(".pg_spot").not("#pg_spot_temp").fadeOut("fast", function() {
						$(this).remove();
					});
					show_spot(json);
				}
			}
		});
	}

	function show_spot(json) {
		$.each(json["list"], function(spot_id, spot_info) {
			var spot_elm = $("#pg_spot_temp").clone(true).attr("id", "");
			spot_elm.css("display", "block");
			
			if (spot_info.image) {
				spot_elm.find(".pg_img img")
					.attr("src", gBaseUrl + "uploads/spot/thumb/" + spot_info.image.file_name);
			}
			
			spot_elm.find(".pg_name")
				.text(spot_info.name);
			
			spot_elm.find(".pg_like_count")
				.addClass("fb-like")
				.attr("data-href", gBaseUrl + 'user/tour/show/' + spot_info.id);
		
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
			spot_elm.appendTo("#pg_spots");
		});
	}

});