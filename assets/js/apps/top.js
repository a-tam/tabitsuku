var page_count = 1;
$(document).ready(function () {

	get_tour({
		owner		: "",
		limit		: 6,
		page		: 1,
		category	: $("#pg_search_category").val(),
		keyword		: $("#pg_search_keyword").val(),
		sort		: "created_time",
		sort_type	: "desc",
	}, ".tour .list_area");

	get_spot({
		owner		: "",
		limit		: 6,
		page		: 1,
		sort		: "created_time",
		sort_type	: "desc"
	}, ".spot .list_area");
	
	// 特集ツアー
	get_tour({
		owner		: "",
		limit		: 3,
		page		: 1,
		keyword		: "",
		sort		: "created_time",
		sort_type	: "desc",
	}, ".special .list_area");

	// 特集スポット
	get_spot({
		owner		: "",
		limit		: 3,
		page		: 1,
		keyword		: "",
		sort		: "created_time",
		sort_type	: "desc"
	}, ".special .list_area");

	// ツアー
	function get_tour(request, class_name) {
		$.ajax({
			url: gBaseUrl + "api/tour",
			data: request,
			dataType: "json",
			success: function(json) {
				if (json["count"] > 0) {
					$.each(json["list"], function(id, info) {
						tourCtl.render(info, json["relation"], class_name);
					});
					commonCtl.iconTips();
				}
				$(class_name + " .pg_description").trunk8({
					lines: 4
				});
			}
		});
	}
	
	// スポット
	function get_spot(request, class_name) {
		$.ajax({
			url: gBaseUrl + "api/spot",
			data: request,
			dataType: "json",
			success: function(json) {
				if (json["count"] > 0) {
					$.each(json["list"], function(id, info) {
						spotCtl.render(info, json["relation"], class_name);
					});
					commonCtl.iconTips();
				}
				$(class_name + " .pg_description").trunk8({
					lines: 4
				});
			}
		});
	}
});