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
	}, "tour");

	get_spot({
		owner		: "",
		limit		: 6,
		page		: 1,
		sort		: "created_time",
		sort_type	: "desc"
	}, "spot");
	
	get_special();
	
	// ツアー
	function get_tour(request, class_name) {
		$.ajax({
			url: gBaseUrl + "api/tour",
			data: request,
			dataType: "json",
			success: function(json) {
				if (json["count"] > 0) {
					show_tour(json, class_name);
				}
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
					show_spot(json, class_name);
				}
			}
		});
	}

	// 特集
	function get_special() {
		get_tour({
			owner		: "",
			limit		: 3,
			page		: 1,
			keyword		: "テスト",
			sort		: "created_time",
			sort_type	: "desc",
		}, "special");

		get_spot({
			owner		: "",
			limit		: 6,
			page		: 1,
			keyword		: "テスト",
			sort		: "created_time",
			sort_type	: "desc"
		}, "special");
	}
	
	function show_tour(json, class_name) {
		$.each(json["list"], function(id, info) {
			var elm = $("."+class_name+" .pg_temp")
				.clone(true)
				.show()
				.removeClass("pg_temp")
				.attr("id", "");
			elm.css("display", "block");
			
			elm.find(".pg_name")
				.text(info.name);
			elm.find(".pg_description")
				.text(info.description);
			elm.find(".pg_like_count")
				.addClass("fb-like")
				.attr("data-href", gBaseUrl + 'user/tour/show/' + info.id);
			
			if (info.image) {
				$(this.routes).each(function(i, route) {
					if (route.id == info.image) {
						elm.find(".pg_img img")
							.attr("src", gBaseUrl + "uploads/spot/thumb/" + route.image.file_name)
							.attr("alt", route.name);
						return;
					}
				});
			}
			
			elm.find(".pg_category").empty();
			if (info.category) {
				$(info.category.split(",")).each(function(i, category_path) {
					category_id = category_path.match(/\d+/g)[0];
					elm.find(".pg_category").append('<dt><img src="' + gAssetUrl + '/img/common/icon/category.gif" alt="CATEGORY" /></dt><dd>' + json["relation"]["categories"][category_id] + '</dd>');
//					var category_name = [];
//					$(category_path.match(/\d+/g)).each(function(i, category_id) {
//						category_name.push(json["relation"]["categories"][category_id]);
//					});
//					elm.find(".pg_category").append('<dt><img src="' + gAssetUrl + '/img/common/icon/category.gif" alt="CATEGORY" /></dt><dd>' + category_name.join(" > ") + '</dd>');
				});
			}

			/*
			elm.find(".pg_tags").empty();
			$(info.tags.match(/\d+/g)).each(function(i, tag_id) {
				elm.find(".pg_tags").append("<li>" + json["relation"]["tags"][tag_id] + "</li>");
			});
			*/
			
			if (info.owner_name) {
				elm.find(".pg_owner")
					.text(info.owner_name);
			}
			
			if (info.routes[0].prefecture) {
				elm.find(".pg_prefecture")
					.text(this.routes[0].prefecture);
			}
			stay_time = 0;
			$(this.routes).each(function(i, route) {
				stay_time += parseInt(route.stay_time);
			});
			elm.find(".pg_stay_time")
				.text(stay_time + "分");
			
//			elm.find(".pg_routes").empty();

			/*
			elm.find(".pg_copy a")
				.attr("href", gBaseUrl + 'user/tour/copy/' + info.id);
			
			*/
			elm.find(".pg_detail")
				.attr("href", gBaseUrl + "tour/show/" + info.id);

			elm.appendTo("."+class_name+" .list_area");
		});
	}

	function show_spot(json, class_name) {
		$.each(json["list"], function(id, info) {
			var elm = $("."+class_name+" .pg_temp")
				.clone(true)
				.show()
				.removeClass("pg_temp")
				.attr("id", info.id);
			elm.css("display", "block");
			
			if (info.image) {
				elm.find(".pg_img img")
					.attr("src", gBaseUrl + "uploads/spot/thumb/" + info.image.file_name);
			}
			
			elm.find(".pg_name")
				.text(info.name);
			elm.find(".pg_description")
				.text(info.description);
			elm.find(".pg_like_count")
				.addClass("fb-like")
				.attr("data-href", gBaseUrl + 'user/spot/show/' + info.id);
		
			if (info.owner_name) {
				elm.find(".pg_owner")
					.text(info.owner_name);
				
			}
			
			if (info.prefecture) {
				elm.find(".pg_prefecture")
					.text(info.prefecture);
				
			} 
				
			elm.find(".pg_stay_time")
				.text(info.stay_time + "分");
			
			elm.find(".pg_category").empty();
			if (info.category) {
				$(info.category.split(",")).each(function(i, category_path) {
					category_id = category_path.match(/\d+/g)[0];
					elm.find(".pg_category").append('<dt><img src="' + gAssetUrl + '/img/common/icon/category.gif" alt="CATEGORY" /></dt><dd>' + json["relation"]["categories"][category_id] + '</dd>');
//					var category_name = [];
//					$(category_path.match(/\d+/g)).each(function(i, category_id) {
//						category_name.push(json["relation"]["categories"][category_id]);
//					});
//					elm.find(".pg_category").append('<dt><img src="' + gAssetUrl + '/img/common/icon/category.gif" alt="CATEGORY" /></dt><dd>' + category_name.join(" > ") + '</dd>');
				});
			}

			elm.find(".pg_tags").empty();
			$(info.tags.match(/\d+/g)).each(function(i, tag_id) {
				elm.find(".pg_tags").append("<li>" + json["relation"]["tags"][tag_id] + "</li>");
			});
			elm.find(".pg_detail")
				.attr("href", gBaseUrl + "spot/show/" + info.id);
			elm.appendTo("."+class_name+" .list_area");
		});
	}

});