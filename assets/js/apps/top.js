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

});