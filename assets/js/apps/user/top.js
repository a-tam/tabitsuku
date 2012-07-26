$(function() {
	$.ajax({
		url: gBaseUrl + "api/tour",
		data: {
			owner: "mydata",
		},
		dataType: "json",
		success: function(json) {
			if (json["count"] > 0) {
				$.each(json["list"], function(tour_id, tour_info) {
					$("#tour_list").append('<li>'+tour_info.name+' [<a href="' + gBaseUrl + '/user/tour/form/' + tour_info.id + '">編集</a>]</li>');
				});
			}
		}
	});
	
	$.ajax({
		url: gBaseUrl + "api/spot",
		data: {
			owner: "mydata"
		},
		dataType: "json",
		success: function(json) {
			if (json["count"] > 0) {
				$.each(json["list"], function(spot_id, spot_info) {
					$("#spot_list").append('<li>'+spot_info.name+' [<a href="' + gBaseUrl + '/user/spot/form/' + spot_info.id + '">編集</a>]</li>');
				});
			}
		}
	});
});