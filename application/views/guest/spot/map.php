<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets");?>/css/modules/user.css" />

<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url("assets");?>/js/apps/guest/spot/map.js"></script>


</head>
<body id="spotsearch" class="search sec">

<?php $this->load->view("contents_header"); ?>
<?php $this->load->view("globalnavi"); ?>


<!-- =============== ↓ページコンテンツ↓ =============== -->
<div class="contents">

	<ul id="breadcrumbs">
		<li><a href="../">トップページ</a></li>
		<li>マイページ</li>
	</ul>
	
	<div class="container">
		<div class="main">

			<?php $this->load->view("guest/search_box"); ?>
		
			<div class="search_info">
				<p class="total">検索結果：<em class="search_count">0</em></p>
				<div class="pager"></div>
				<!-- //pager -->
				<!-- <div class="pagenation" style="clear:both;"></div> -->
				
			</div>
			<!-- //search_info -->

			<div class="entries">
				<div id="map_area">
					<div id="mapsearch" class="mouse_over">
						<p class="search"><input type="text" class="text" id="search-address" /><input type="image" class="btn" src="<?php echo base_url("assets");?>/img/common/header/searchbtn.gif" alt="検索" /></p>
					</div>
					<div id="map"></div>
				</div>
				<!-- //maparea -->
				
		
				<div class="list_area" id="pg_spots">
					<div class="list_item pg_temp pg_spot_list" style="display:none;">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="スポット" /></p>
						<div class="photo_area pg_img">
							<p><a href="../spot/" class="pg_detail"><img src="<?php echo base_url("assets");?>/img/common/noimage_s.jpg" alt="" /></a></p>
							<div class="pg_like_count" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
							<dl class="category pg_category">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
								<dd>
									<ul class="category_icon">
										<li><a href="" title="見る"><img src="<?php echo base_url("assets");?>/img/common/icon/site.gif" alt="見る" /></a></li>
										<li><a href="" title="遊ぶ"><img src="<?php echo base_url("assets");?>/img/common/icon/enjoy.gif" alt="遊ぶ" /></a></li>
										<li><a href="" title="食べる"><img src="<?php echo base_url("assets");?>/img/common/icon/food.gif" alt="食べる" /></a></li>
										<li><a href="" title="宿泊・温泉"><img src="<?php echo base_url("assets");?>/img/common/icon/stay.gif" alt="宿泊・温泉" /></a></li>
										<li><a href="" title="乗り物/乗り場"><img src="<?php echo base_url("assets");?>/img/common/icon/transport.gif" alt="乗り物/乗り場" /></a></li>
										<li><a href="" title="買う"><img src="<?php echo base_url("assets");?>/img/common/icon/shopping.gif" alt="買う" /></a></li>
									</ul>
								</dd>
							</dl>
						</div>
						<!-- //photo_area -->
			
						<div class="info_area">
							<dl class="maininfo">
								<dt class="pg_name">スポット名スポット名スポット名</dt>
								<dd class="pg_description">当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
							
							<p class="linkbtn">
							<a href="../spot/" class="mouse_over pg_detail">スポット詳細を見る</a>
							<!--
							<a href="../spot/" class="mouse_over pg_edit">スポットを編集する</a>
							<a href="../spot/" class="mouse_over pg_delete">スポットを削除する</a>
							-->
							</p>
							
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
			
				</div>
				<!-- //list_area -->

			</div>
			<!-- //entries -->


			<div class="search_info">
				<p class="total">検索結果：<em class="search_count">67</em></p>
				<div class="pager"></div>
				<!-- //pager -->
				<!--
				<div class="pagenation" style="clear:both;"></div>
				 -->
				
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

