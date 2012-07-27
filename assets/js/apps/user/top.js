$(function() {
	var map;
	
	$( "#pg_tabs" ).tabs({
		show: function(event, ui){
			if (ui.index == 0) {
				load_map(ui.panel.id, -34.397, 150.644, 8);
				show_spot();
			} else if (ui.index==1) {
				load_map(ui.panel.id, 34.397, 135.644, 8);
				show_tour();
			}
		}
	});
	
	function load_map(placeholder, lat, lng, z) {
		var myOptions = {
				zoom: z,
				center: new google.maps.LatLng(lat, lng),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
		map = new google.maps.Map($("#"+placeholder).find(".pg_map")[0], myOptions);
	}
	
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
						$("#tour_list").append('<li>'+tour_info.name+' [<a href="' + gBaseUrl + '/user/tour/form/' + tour_info.id + '">編集</a>]</li>');
					});
				}
			}
		});
	}
	
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
						$("#spot_list").append('<li>'+spot_info.name+' [<a href="' + gBaseUrl + '/user/spot/form/' + spot_info.id + '">編集</a>]</li>');
					});
				}
			}
		});
	}
});