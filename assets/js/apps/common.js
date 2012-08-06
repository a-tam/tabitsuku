var FB = null;
var google = null;
$(function() {
	if (!FB) {
		return false;
	}
	// like
	FB.Event.subscribe('edge.create', function(response) {
		var url = $.url(response);
		var path_info = url.attr("path").split("/");
		var fb_auth = FB.getAuthResponse();
		$.ajax({
			url: gBaseUrl + "user/spot/like_plus",
			async: false,
			data: {
				user_id: fb_auth.userID,
				spot_id: path_info[path_info.length -1]
			},
			dataType: "json",
			type: "post",
			success: function(json) {
				console.log(json);
			},
			error: function() {
				console.log(arguments);
			}
		});
	});
	// not like
	FB.Event.subscribe('edge.remove', function(response) {
		var url = $.url(response);
		var path_info = url.attr("path").split("/");
		var fb_auth = FB.getAuthResponse();
		// ソート順用
		$.ajax({
			url: gBaseUrl + "user/spot/like_minus",
			async: false,
			data: {
				user_id: fb_auth.userID,
				spot_id: path_info[path_info.length -1]
			},
			dataType: "json",
			type: "post",
			success: function(json) {
				console.log(json);
			},
			error: function() {
				console.log(arguments);
			}
		});
	});
});

(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=248010585308088";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));