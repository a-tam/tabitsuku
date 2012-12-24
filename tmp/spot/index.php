<!doctype html>
<html lang="ja">
<head>
	<meta charset="UTF-8" />
	<meta http-equiv="Content-Language" content="ja" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<meta name="description" content="" />
	<meta name="robots" content="ALL" />

	<title>スポット名スポット名スポット名 | スポット | たびつく　自分だけの旅行プランを作ろう</title>
	
	<meta name="viewport" content="width=1010">

	<link rel="stylesheet" type="text/css" media="screen,print" href="../css/import.css" />
	<link rel="stylesheet" type="text/css" media="screen,print" href="../css/modules/spot.css" />
	<link rel="start index" href="/" title="たびつく　自分だけの旅行プランを作ろう" />
	
	<script type="text/javascript" src="../jquery/jquery.js"></script>
	<script type="text/javascript" src="../jquery/jquery.easing.js"></script>
	<script type="text/javascript" src="../jquery/jquery.powertip.min.js"></script>
	<script type="text/javascript" src="../js/browser.js"></script>
	<script type="text/javascript" src="../js/common.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
	<script type="text/javascript" src="../js/spot.js"></script>

	<!--[if lte IE 8]>
	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>
<?php if(isset($_GET["mode"]) && $_GET["mode"]=="direct"){ ?>
<body id="spot" class="sec spotdirect">
<?php }else{ ?>
<body id="spot" class="sec">
<?php }?>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<header>
	<h1><a href="../"><img src="../images/logo.gif" alt="たびつく　自分だけの旅行プランを作ろう" /></a></h1>
	<dl class="search">
		<dt><img src="../images/common/header/search.gif" alt="ツアーやスポットを検索しよう" /></dt>
		<dd>
			<form>
				<p class="categoryselect">
					<select class="category" name="category">
						<option>全てのカテゴリ</option>
						<option>見る</option>
						<option>遊ぶ</option>
						<option>食べる</option>
						<option>宿泊・温泉</option>
						<option>乗り物/乗り場</option>
						<option>買う</option>
					</select>
				</p>
				<ul>
					<li><input type="radio" name="type" value="ツアー" id="headersearch_tour"><label for="headersearch_tour">ツアー</label></li>
					<li><input type="radio" name="type" value="スポット" id="headersearch_spot"><label for="headersearch_spot">スポット</label></li>
				</ul>
				<p class="keyword"><input type="text" class="text" name="keyword" value="" /></p>
				<p class="submit mouse_over"><input type="submit" class="submitbtn" value="検索" /></p>
			</form>
		</dd>
	</dl>
	<!-- //search -->
	<p class="login"><a href="#login" class="loginbtn mouse_over"><img src="../images/common/header/login.gif" alt="ログインはこちら" /></a></p>
</header>


<nav id="globalnavi">
	<ul>
		<li class="top"><a href="../"><img src="../images/common/navi/top.gif" alt="トップページ"></a></li>
		<li class="spotsearch"><a href="../search/"><img src="../images/common/navi/spotsearch.gif" alt="スポット検索"></a></li>
		<li class="toursearch"><a href="../search/"><img src="../images/common/navi/toursearch.gif" alt="ツアー検索"></a></li>
		<li class="spot"><a href="../user/spot/"><img src="../images/common/navi/spot.gif" alt="スポット登録"></a></li>
		<li class="tour"><a href="../user/tour/"><img src="../images/common/navi/tour.gif" alt="ツアー作成"></a></li>
		<li class="maypage"><a href="../user/"><img src="../images/common/navi/mypage.gif" alt="マイページ"></a></li>
	</ul>
</nav>
<!-- //globalnavi -->



<!-- =============== ↓ページコンテンツ↓ =============== -->
<div class="contents">

	<ul id="breadcrumbs">
		<li><a href="../">トップページ</a></li>
		<li>スポット名スポット名スポット名スポット名</li>
	</ul>	


	<div id="map_area">
		<div id="map"></div>
	</div>
	<!-- //maparea -->
	
	<div id="detail_area">
		<p class="photo"><img src="../images/spot/sample.jpg" alt="スポット名スポット名スポット名スポット名" /></p>
		<div class="info">
			<h2>スポット名スポット名スポット名スポット名</h2>
			
			<div class="subinfo">
				<dl>
					<dt><img src="../images/common/icon/name.gif" alt="作成者" /></dt>
					<dd>田中一郎</dd>
				</dl>
				<dl>
					<dt><img src="../images/common/icon/location.gif" alt="場所" /></dt>
					<dd>東京駅</dd>
				</dl>
				<dl>
					<dt><img src="../images/common/icon/time.gif" alt="時間" /></dt>
					<dd>2時間ツアー</dd>
				</dl>
				<dl class="category">
					<dt><img src="../images/common/icon/category_l.gif" alt="CATEGORY" /></dt>
					<dd>
						<ul>
							<li><a href="">見る</a></li>
							<li><a href="">イタリアン</a></li>
						</ul>
					</dd>
				</dl>
				<dl class="tag">
					<dt><img src="../images/common/icon/tag_l.gif" alt="タグ" /></dt>
					<dd>
						<ul>
							<li><a href="">街歩き</a></li>
							<li><a href="">観光</a></li>
							<li><a href="">ランチ</a></li>
						</ul>
					</dd>
				</dl>
			</div>
			<!-- //subinfo -->
			
		</div>
		<!-- //info -->
		
		<dl class="comment">
			<dt><img src="../images/common/icon/memo.gif" alt="一言メモ" /></dt>
			<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、</dd>
		</dl>

		<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
		
		<p class="edit"><a href="../user/spot/" class="selectbtn mouse_over">編集する</a></p>
		
	</div>
	<!-- //detail_area -->


	<section class="othertour">
		<h3><img src="../images/spot/tour.gif" alt="このスポットが含まれるツアー" /></h3>
		<div class="list_area">
			<div class="list_item">
				<p class="icon"><img src="../images/common/icon/tour.png" alt="ツアー" /></p>
				
				<div class="photo_area">
					<p><a href="../tour/"><img src="../images/top/sample.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
					<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<dl class="category">
						<dt><img src="../images/common/icon/category.gif" alt="CATEGORY" /></dt>
						<dd>
							<ul class="category_icon">
								<li><a href="" title="見る"><img src="../images/common/icon/site.gif" alt="見る" /></a></li>
								<li><a href="" title="遊ぶ"><img src="../images/common/icon/enjoy.gif" alt="遊ぶ" /></a></li>
								<li><a href="" title="食べる"><img src="../images/common/icon/food.gif" alt="食べる" /></a></li>
							</ul>
						</dd>
					</dl>
				</div>
				<!-- //photo_area -->
	
				<div class="info_area">
					<dl class="maininfo">
						<dt>ツアー名ツアー名ツアー名</dt>
						<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
					</dl>
					<!-- //maininfo -->
					
					<div class="subinfo">
						<dl>
							<dt><img src="../images/common/icon/name.gif" alt="作成者" /></dt>
							<dd>田中一郎</dd>
						</dl>
						<dl>
							<dt><img src="../images/common/icon/departure.gif" alt="出発地" /></dt>
							<dd>東京駅</dd>
						</dl>
						<dl>
							<dt><img src="../images/common/icon/time.gif" alt="時間" /></dt>
							<dd>2時間ツアー</dd>
						</dl>
					</div>
					<!-- //subinfo -->
	
					<p class="linkbtn"><a href="../tour/" class="mouse_over">ツアー内容を見る</a></p>
	
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //list_item -->
	
			<div class="list_item">
				<p class="icon"><img src="../images/common/icon/tour.png" alt="ツアー" /></p>
				
				<div class="photo_area">
					<p><a href="../tour/"><img src="../images/common/noimage.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
					<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<dl class="category">
						<dt><img src="../images/common/icon/category.gif" alt="CATEGORY" /></dt>
						<dd>
							<ul class="category_icon">
								<li><a href="" title="見る"><img src="../images/common/icon/site.gif" alt="見る" /></a></li>
								<li><a href="" title="遊ぶ"><img src="../images/common/icon/enjoy.gif" alt="遊ぶ" /></a></li>
								<li><a href="" title="食べる"><img src="../images/common/icon/food.gif" alt="食べる" /></a></li>
							</ul>
						</dd>
					</dl>
				</div>
				<!-- //photo_area -->
	
				<div class="info_area">
					<dl class="maininfo">
						<dt>ツアー名ツアー名ツアー名</dt>
						<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
					</dl>
					<!-- //maininfo -->
					
					<div class="subinfo">
						<dl>
							<dt><img src="../images/common/icon/name.gif" alt="作成者" /></dt>
							<dd>田中一郎</dd>
						</dl>
						<dl>
							<dt><img src="../images/common/icon/departure.gif" alt="出発地" /></dt>
							<dd>東京駅八重洲南口改札</dd>
						</dl>
						<dl>
							<dt><img src="../images/common/icon/time.gif" alt="時間" /></dt>
							<dd>2時間ツアー</dd>
						</dl>
					</div>
					<!-- //subinfo -->
	
					<p class="linkbtn"><a href="../tour/" class="mouse_over">ツアー内容を見る</a></p>
	
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //list_item -->
	
			<div class="list_item">
				<p class="icon"><img src="../images/common/icon/tour.png" alt="ツアー" /></p>
				
				<div class="photo_area">
					<p><a href="../tour/"><img src="../images/top/sample.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
					<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<dl class="category">
						<dt><img src="../images/common/icon/category.gif" alt="CATEGORY" /></dt>
						<dd>
							<ul class="category_icon">
								<li><a href="" title="見る"><img src="../images/common/icon/site.gif" alt="見る" /></a></li>
								<li><a href="" title="遊ぶ"><img src="../images/common/icon/enjoy.gif" alt="遊ぶ" /></a></li>
								<li><a href="" title="食べる"><img src="../images/common/icon/food.gif" alt="食べる" /></a></li>
							</ul>
						</dd>
					</dl>
				</div>
				<!-- //photo_area -->
	
				<div class="info_area">
					<dl class="maininfo">
						<dt>ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名</dt>
						<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
					</dl>
					<!-- //maininfo -->
					
					<div class="subinfo">
						<dl>
							<dt><img src="../images/common/icon/name.gif" alt="作成者" /></dt>
							<dd></dd>
						</dl>
						<dl>
							<dt><img src="../images/common/icon/departure.gif" alt="出発地" /></dt>
							<dd>東京駅</dd>
						</dl>
						<dl>
							<dt><img src="../images/common/icon/time.gif" alt="時間" /></dt>
							<dd>2時間ツアー</dd>
						</dl>
					</div>
					<!-- //subinfo -->
	
					<p class="linkbtn"><a href="../tour/" class="mouse_over">ツアー内容を見る</a></p>
	
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //list_item -->

			<div class="list_item">
				<p class="icon"><img src="../images/common/icon/tour.png" alt="ツアー" /></p>
				
				<div class="photo_area">
					<p><a href="../tour/"><img src="../images/top/sample.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
					<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<dl class="category">
						<dt><img src="../images/common/icon/category.gif" alt="CATEGORY" /></dt>
						<dd>
							<ul class="category_icon">
								<li><a href="" title="見る"><img src="../images/common/icon/site.gif" alt="見る" /></a></li>
								<li><a href="" title="遊ぶ"><img src="../images/common/icon/enjoy.gif" alt="遊ぶ" /></a></li>
								<li><a href="" title="食べる"><img src="../images/common/icon/food.gif" alt="食べる" /></a></li>
							</ul>
						</dd>
					</dl>
				</div>
				<!-- //photo_area -->
	
				<div class="info_area">
					<dl class="maininfo">
						<dt>ツアー名ツアー名ツアー名</dt>
						<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
					</dl>
					<!-- //maininfo -->
					
					<div class="subinfo">
						<dl>
							<dt><img src="../images/common/icon/name.gif" alt="作成者" /></dt>
							<dd>田中一郎</dd>
						</dl>
						<dl>
							<dt><img src="../images/common/icon/departure.gif" alt="出発地" /></dt>
							<dd>東京駅</dd>
						</dl>
						<dl>
							<dt><img src="../images/common/icon/time.gif" alt="時間" /></dt>
							<dd>2時間ツアー</dd>
						</dl>
					</div>
					<!-- //subinfo -->
	
					<p class="linkbtn"><a href="../tour/" class="mouse_over">ツアー内容を見る</a></p>
	
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //list_item -->

			<div class="list_item">
				<p class="icon"><img src="../images/common/icon/tour.png" alt="ツアー" /></p>
				
				<div class="photo_area">
					<p><a href="../tour/"><img src="../images/top/sample.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
					<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<dl class="category">
						<dt><img src="../images/common/icon/category.gif" alt="CATEGORY" /></dt>
						<dd>
							<ul class="category_icon">
								<li><a href="" title="見る"><img src="../images/common/icon/site.gif" alt="見る" /></a></li>
								<li><a href="" title="遊ぶ"><img src="../images/common/icon/enjoy.gif" alt="遊ぶ" /></a></li>
								<li><a href="" title="食べる"><img src="../images/common/icon/food.gif" alt="食べる" /></a></li>
							</ul>
						</dd>
					</dl>
				</div>
				<!-- //photo_area -->
	
				<div class="info_area">
					<dl class="maininfo">
						<dt>ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名</dt>
						<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
					</dl>
					<!-- //maininfo -->
					
					<div class="subinfo">
						<dl>
							<dt><img src="../images/common/icon/name.gif" alt="作成者" /></dt>
							<dd></dd>
						</dl>
						<dl>
							<dt><img src="../images/common/icon/departure.gif" alt="出発地" /></dt>
							<dd>東京駅</dd>
						</dl>
						<dl>
							<dt><img src="../images/common/icon/time.gif" alt="時間" /></dt>
							<dd>2時間ツアー</dd>
						</dl>
					</div>
					<!-- //subinfo -->
	
					<p class="linkbtn"><a href="../tour/" class="mouse_over">ツアー内容を見る</a></p>
	
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //list_item -->
	
			<div class="list_item">
				<p class="icon"><img src="../images/common/icon/tour.png" alt="ツアー" /></p>
				
				<div class="photo_area">
					<p><a href="../tour/"><img src="../images/common/noimage.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
					<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<dl class="category">
						<dt><img src="../images/common/icon/category.gif" alt="CATEGORY" /></dt>
						<dd>
							<ul class="category_icon">
								<li><a href="" title="見る"><img src="../images/common/icon/site.gif" alt="見る" /></a></li>
								<li><a href="" title="遊ぶ"><img src="../images/common/icon/enjoy.gif" alt="遊ぶ" /></a></li>
								<li><a href="" title="食べる"><img src="../images/common/icon/food.gif" alt="食べる" /></a></li>
							</ul>
						</dd>
					</dl>
				</div>
				<!-- //photo_area -->
	
				<div class="info_area">
					<dl class="maininfo">
						<dt>ツアー名ツアー名ツアー名</dt>
						<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
					</dl>
					<!-- //maininfo -->
					
					<div class="subinfo">
						<dl>
							<dt><img src="../images/common/icon/name.gif" alt="作成者" /></dt>
							<dd>田中一郎</dd>
						</dl>
						<dl>
							<dt><img src="../images/common/icon/departure.gif" alt="出発地" /></dt>
							<dd>東京駅八重洲南口改札</dd>
						</dl>
						<dl>
							<dt><img src="../images/common/icon/time.gif" alt="時間" /></dt>
							<dd>2時間ツアー</dd>
						</dl>
					</div>
					<!-- //subinfo -->
	
					<p class="linkbtn"><a href="../tour/" class="mouse_over">ツアー内容を見る</a></p>
	
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //list_item -->

		</div>
		<!-- //list_area -->
	</section>
	<!-- //othertour -->
	


</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->

<footer>
	<nav>
		<ul>
			<li><a href="../about/">このサイトについて</a></li>
			<li><a href="../howto/">たびつくの使い方</a></li>
			<li><a href="../contact/">お問い合わせ</a></li>
			<li><a href="../rule/">利用規約</a></li>
		</ul>
	</nav>
</footer>



<div id="loginArea">
	<p class="cover"></p>
	<iframe src="../login/" width="780" height="300" allowtransparency="true"></iframe>
</div>
<!-- //loginArea -->


</body>
</html>