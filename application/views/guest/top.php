<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets"); ?>/css/modules/top.css" />
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/top.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/top.js"></script>

</head>
<body id="index">
	
<?php $this->load->view("contents_header"); ?>
	
<div id="mainvisual">
	<h2><img src="<?php echo base_url("assets"); ?>/img/top/main_pic.gif" alt="自分だけの旅行プランを作ろう" /></h2>
	<div class="message-area">
		<p><img src="<?php echo base_url("assets"); ?>/img/top/main_txt.gif" alt="たびつくは、みんなで登録したスポットをつないで自分だけの旅行プランを作れるサービスです。" /></p>
		<ul>
			<li><a href="<?php echo base_url("top/about/");?>" class="mouse_over"><img src="<?php echo base_url("assets"); ?>/img/top/about.gif" alt="たびつくとは" /></a></li>
			<li><a href="<?php echo base_url("top/howto/");?>" class="mouse_over"><img src="<?php echo base_url("assets"); ?>/img/top/howto.gif" alt="たびつくの使い方" /></a></li>
		</ul>
	</div>
	<!-- //message-area -->
	
	<div class="movie-area">
		<iframe width="300" height="200" src="http://www.youtube.com/embed/Jy9kT2AWH04" frameborder="0" allowfullscreen></iframe>
	</div>
	<!--
	<div class="login-area">
		<h3><img src="<?php echo base_url("assets"); ?>/img/top/login.gif" alt="ログインはこちらから" /></h3>
		<p class="facebook"><a href="<?php echo $data["fb_login"]; ?>" class="mouse_over"><img src="<?php echo base_url("assets"); ?>/img/common/facebook.gif" alt="Facebookアカウントでログイン"></a></p>
		
		<form action="<?php echo base_url("user/top/login"); ?>" method="post">
		<dl>
			<dt><img src="<?php echo base_url("assets"); ?>/img/top/userid.gif" alt="ユーザーID" /></dt>
			<dd><input type="text" class="text" name="login_id" /></dd>
		</dl>
		<dl>
			<dt><img src="<?php echo base_url("assets"); ?>/img/top/password.gif" alt="パスワード" /></dt>
			<dd><input type="password" class="text" name="password" /></dd>
		</dl>
		<p class="login mouse_over"><input type="image" src="<?php echo base_url("assets"); ?>/img/top/loginbtn.gif" alt="ログイン"/></p>
		<p class="regist"><a href="" class="mouse_over"><img src="<?php echo base_url("assets"); ?>/img/top/registbtn.gif" alt="新規登録" /></a></p>
		</form>
	</div>
	<!-- //login-area -->
	
</div>
<!-- //mainvisual -->

<?php $this->load->view("globalnavi"); ?>


<!-- =============== ↓ページコンテンツ↓ =============== -->
<div class="contents">


	<section class="tour">
		<h3><img src="<?php echo base_url("assets"); ?>/img/top/newtour.gif" alt="ツアー新着" /></h3>
		
		<div class="list_area">
			<div class="list_item pg_temp" style="display:none;">
				<p class="icon"><img src="<?php echo base_url("assets"); ?>/img/common/icon/tour.png" alt="ツアー" /></p>
				<div class="photo_area pg_img">
					<p>
						<a href="./" class="pg_detail">
							<img src="<?php echo base_url("assets"); ?>/img/common/noimage.jpg" width="137" height="104" alt="" />
						</a>
					</p>
					<div class="pg_like_count" data-href="" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<dl class="category pg_category">
						<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
						<dd>
							<ul class="category_icon">
								<li><a href="" title="見る"><img src="<?php echo base_url("assets"); ?>/img/common/icon/site.gif" alt="見る" /></a></li>
								<li><a href="" title="遊ぶ"><img src="<?php echo base_url("assets"); ?>/img/common/icon/enjoy.gif" alt="遊ぶ" /></a></li>
								<li><a href="" title="食べる"><img src="<?php echo base_url("assets"); ?>/img/common/icon/food.gif" alt="食べる" /></a></li>
								<li><a href="" title="宿泊・温泉"><img src="<?php echo base_url("assets"); ?>/img/common/icon/stay.gif" alt="宿泊・温泉" /></a></li>
								<li><a href="" title="乗り物/乗り場"><img src="<?php echo base_url("assets"); ?>/img/common/icon/transport.gif" alt="乗り物/乗り場" /></a></li>
								<li><a href="" title="買う"><img src="<?php echo base_url("assets"); ?>/img/common/icon/shopping.gif" alt="買う" /></a></li>
							</ul>
						</dd>
					</dl>
				</div>
				<!-- //photo_area -->
	
				<div class="info_area">
					<dl class="maininfo">
						<dt class="pg_name">ツアー名</dt>
						<dd class="pg_description">当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
					</dl>
					<!-- //maininfo -->
					
					<div class="subinfo">
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/name.gif" alt="作成者" /></dt>
							<dd class="pg_owner">作成者名</dd>
						</dl>
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/departure.gif" alt="出発地" /></dt>
							<dd class="pg_prefecture">--</dd>
						</dl>
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/time.gif" alt="時間" /></dt>
							<dd class="pg_stay_time">40分</dd>
						</dl>
					</div>
					<!-- //subinfo -->
					<p class="linkbtn"><a href="../tour/" class="mouse_over pg_detail">ツアー内容を見る</a></p>
	
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //list_item -->
	
		</div>
		<!-- //list_area -->
	</section>
	<!-- //tour -->

	<section class="spot">
		<h3><img src="<?php echo base_url("assets"); ?>/img/top/newspot.gif" alt="スポット新着" /></h3>
		
		<div class="list_area">
			<div class="list_item pg_temp" style="display:none;">
				<p class="icon"><img src="<?php echo base_url("assets"); ?>/img/common/icon/spot.png" alt="スポット" /></p>
				
				<div class="photo_area pg_img">
					<p><a href="./" class="pg_detail">
						<img src="<?php echo base_url("assets");?>/img/common/noimage.jpg" width="137" height="104" alt="" />
					</a></p>
					<div class="pg_like_count" data-href="" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<dl class="category pg_category">
						<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
						<dd>
							<ul class="category_icon">
								<li><a href="" title="見る"><img src="<?php echo base_url("assets"); ?>/img/common/icon/site.gif" alt="見る" /></a></li>
								<li><a href="" title="遊ぶ"><img src="<?php echo base_url("assets"); ?>/img/common/icon/enjoy.gif" alt="遊ぶ" /></a></li>
								<li><a href="" title="食べる"><img src="<?php echo base_url("assets"); ?>/img/common/icon/food.gif" alt="食べる" /></a></li>
								<li><a href="" title="宿泊・温泉"><img src="<?php echo base_url("assets"); ?>/img/common/icon/stay.gif" alt="宿泊・温泉" /></a></li>
								<li><a href="" title="乗り物/乗り場"><img src="<?php echo base_url("assets"); ?>/img/common/icon/transport.gif" alt="乗り物/乗り場" /></a></li>
								<li><a href="" title="買う"><img src="<?php echo base_url("assets"); ?>/img/common/icon/shopping.gif" alt="買う" /></a></li>
							</ul>
						</dd>
					</dl>
				</div>
				<!-- //photo_area -->
	
				<div class="info_area">
					<dl class="maininfo">
						<dt class="pg_name">スポット名</dt>
						<dd class="pg_description">当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
					</dl>
					<!-- //maininfo -->
					
					<div class="subinfo">
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/name.gif" alt="作成者" /></dt>
							<dd class="pg_owner">--</dd>
						</dl>
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/location.gif" alt="場所" /></dt>
							<dd class="pg_prefecture">--</dd>
						</dl>
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/time.gif" alt="時間" /></dt>
							<dd class="pg_stay_time">30分</dd>
						</dl>
					</div>
					<!-- //subinfo -->
	
					<p class="linkbtn"><a href="../tour/" class="mouse_over pg_detail">スポット詳細を見る</a></p>
	
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //list_item -->
			
		</div>
		<!-- //list_area -->
	</section>
	<!-- //spot -->


	<section class="special">
		<h3><img src="<?php echo base_url("assets"); ?>/img/top/special.gif" alt="たびつく特集" /></h3>
		
		<div class="list_area">
			<div class="list_item pg_temp" style="display:none;">
				<p class="icon"><img src="<?php echo base_url("assets"); ?>/img/common/icon/tour.png" alt="ツアー" /></p>
				
				<div class="photo_area pg_img">
					<p><a href="./" class="pg_detail">
						<img src="<?php echo base_url("assets"); ?>/img/common/noimage.jpg" width="137" height="104" alt="" />
					</a></p>
					<div class="pg_like_count" data-href="" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<dl class="category pg_category">
						<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
						<dd>
							<ul class="category_icon">
								<li><a href="" title="見る"><img src="<?php echo base_url("assets"); ?>/img/common/icon/site.gif" alt="見る" /></a></li>
								<li><a href="" title="遊ぶ"><img src="<?php echo base_url("assets"); ?>/img/common/icon/enjoy.gif" alt="遊ぶ" /></a></li>
								<li><a href="" title="食べる"><img src="<?php echo base_url("assets"); ?>/img/common/icon/food.gif" alt="食べる" /></a></li>
								<li><a href="" title="宿泊・温泉"><img src="<?php echo base_url("assets"); ?>/img/common/icon/stay.gif" alt="宿泊・温泉" /></a></li>
								<li><a href="" title="乗り物/乗り場"><img src="<?php echo base_url("assets"); ?>/img/common/icon/transport.gif" alt="乗り物/乗り場" /></a></li>
								<li><a href="" title="買う"><img src="<?php echo base_url("assets"); ?>/img/common/icon/shopping.gif" alt="買う" /></a></li>
							</ul>
						</dd>
					</dl>
				</div>
				<!-- //photo_area -->
	
				<div class="info_area">
					<dl class="maininfo">
						<dt class="pg_name">ツアー名</dt>
						<dd class="pg_description">当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
					</dl>
					<!-- //maininfo -->
					
					<div class="subinfo">
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/name.gif" alt="作成者" /></dt>
							<dd class="pg_owner">--</dd>
						</dl>
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/departure.gif" alt="出発地" /></dt>
							<dd class="pg_prefecture">--</dd>
						</dl>
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/time.gif" alt="時間" /></dt>
							<dd class="pg_stay_time">120分</dd>
						</dl>
					</div>
					<!-- //subinfo -->
	
					<p class="linkbtn"><a href="../tour/" class="mouse_over pg_detail">ツアー内容を見る</a></p>
	
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //list_item -->
			
		</div>
		<!-- //list_area -->
	</section>
	<!-- //special -->

</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->