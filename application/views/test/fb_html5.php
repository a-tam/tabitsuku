<html>
<head>
<title>html5</title>
<meta charset="utf8">
</head>
<body>
<div id="fb-root"></div>
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
</script><script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=248010585308088";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<h1>ヘッダ</h1>
<div class="fb-like" data-href="http://p0009.kiyomizu.mac/test/fb/html5" data-send="true" data-width="450" data-show-faces="true"></div>
<div>フッタ</div>
</body>
</html>