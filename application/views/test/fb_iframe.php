<html>
<head>
<title>iframe</title>
<meta charset="utf8">
</head>
<body>
<script>
window.onload = function() {
	FB.Event.subscribe('edge.create',
		    function(response) {
		        alert('You liked the URL: ' + response);
		    }
		);
	FB.Event.subscribe('edge.remove',
		    function(response) {
		        alert('You liked the URL: ' + response);
		    }
		);
};
</script>
<h1>ヘッダ</h1>
<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fp0009.kiyomizu.mac%2Ftest%2Ffb%2Fhtml5&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=80&amp;appId=248010585308088" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>
<div>フッタ</div>
</body>
</html>