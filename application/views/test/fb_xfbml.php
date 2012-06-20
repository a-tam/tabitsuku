<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<title>xfbml</title>
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

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=248010585308088";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<h1>ヘッダ</h1>
<fb:like href="http://p0009.kiyomizu.mac/test/fb/html5" send="true" width="450" show_faces="true"></fb:like>
<div>フッタ</div>
</body>
</html>