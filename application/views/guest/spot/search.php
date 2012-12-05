<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets"); ?>/css/modules/search.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets");?>/js/jquery/jpagenate/css/style.css">

<!-- javascript -->
<script type="text/javascript" src="<?php echo base_url("assets");?>/js/search.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets");?>/js/apps/guest/spot/search.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets");?>/js/jquery/jpagenate/jquery.paginate.js"></script>

</head>
<body id="spotsearch" class="search sec">

<?php $this->load->view("contents_header"); ?>
<?php $this->load->view("globalnavi"); ?>

<!-- =============== ↓ページコンテンツ↓ =============== -->
<div class="contents">

	<ul id="breadcrumbs">
		<li><a href="../">トップページ</a></li>
		<li>検索結果</li>
	</ul>

	<div class="container">
		<div class="main">
		
			<?php $this->load->view("guest/search_box"); ?>

			<div class="search_info">
				<p class="total">検索結果：<em class="search_count">67</em></p>
				
				<div class="pager">
					<p class="order">
						<select name="order">
							<option value="new">新着順</option>
						</select>
					</p>
					<!--
					<p class="prev"><a href="">前へ</a></p>
					<ul>
						<li class="select">1</li>
						<li><a href="">2</a></li>
						<li><a href="">3</a></li>
						<li><a href="">4</a></li>
						<li><a href="">5</a></li>
						<li>...<a href="">46</a></li>
					</ul>
					<p class="next"><a href="">次へ</a></p>
					-->
				</div>
				<!-- // -->
				<div class="pagenation" style="clear:both;"></div>
				
			</div>
			<!-- //search_info -->
		
			<div class="list_area">

				<div class="list_item pg_temp" style="display:none;">
					<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="ツアー" /></p>
					
					<p class="photo pg_img"><a href="">
						<img src="<?php echo base_url("assets"); ?>/img/common/noimage.jpg" width="137" height="104" alt="スポット名" />
					</a></p>
					
					<div class="info_area">
						<dl class="maininfo">
							<dt class="pg_name">スポット名</dt>
							<dd class="pg_description">当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
						</dl>
						<!-- //maininfo -->
						
						<div class="subinfo">
							<dl class="name">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/name.gif" alt="作成者" /></dt>
								<dd class="pg_owner">田中一郎</dd>
							</dl>
							<dl class="departure">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/location.gif" alt="場所" /></dt>
								<dd class="pg_prefectuer">東京駅</dd>
							</dl>
							<dl class="time">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/time.gif" alt="時間" /></dt>
								<dd class="pg_time">2時間ツアー</dd>
							</dl>
						</div>
						<!-- //subinfo -->
					</div>
					<!-- //info_area -->
		
					<div class="sub_box">
						<div class="pg_like_count fb-like" data-href="http://www.yahoo.co.jp" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
						<dl class="category">
							<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
							<dd>
								<ul class="pg_category">
									<li><a href="">見る</a></li>
									<li><a href="">遊ぶ</a></li>
									<li><a href="">宿泊・温泉</a></li>
								</ul>
							</dd>
						</dl>
						<p class="linkbtn pg_detail"><a href="http://www.yahoo.co.jp" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット内容を見る"></a></p>
					</div>
					<!-- //sub_box -->
		
				</div>
				<!-- //list_item -->
			
				
			</div>
			<!-- //list_area -->
	
	
			<div class="search_info">
				<p class="total">検索結果：<em>67</em></p>
				
				<div class="pager">
					<p class="order">
						<select name="order">
							<option value="new">新着順</option>
						</select>
					</p>
				
					<p class="prev"><a href="">前へ</a></p>
					<ul>
						<li class="select">1</li>
						<li><a href="">2</a></li>
						<li><a href="">3</a></li>
						<li><a href="">4</a></li>
						<li><a href="">5</a></li>
						<li>...<a href="">46</a></li>
					</ul>
					<p class="next"><a href="">次へ</a></p>
				</div>
				<!-- // -->
				
			</div>
			<!-- //search_info -->
		
	
		</div>
		<!-- //main -->
		
	
	
		<div class="side">
		
			<?php $this->load->view("guest/side");?>
					
		</div>
		<!-- //side -->

	</div>
	<!-- //container -->


</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->