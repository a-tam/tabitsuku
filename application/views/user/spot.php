<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets");?>/css/modules/user.css" />

<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?php echo base_url("assets");?>/js/userspot.js"></script>

</head>
<body id="user" class="sec spot">

<?php $this->load->view("contents_header"); ?>
<?php $this->load->view("globalnavi"); ?>


<!-- =============== ↓ページコンテンツ↓ =============== -->
<div class="contents">

	<ul id="breadcrumbs">
		<li><a href="../">トップページ</a></li>
		<li>マイページ</li>
	</ul>
	
	<div id="select_area">
		<ul>
			<li class="tour"><a href="<?php echo base_url("user");?>"><img src="<?php echo base_url("assets");?>/img/user/top/tour.gif" alt="あなたが登録したツアー" /><span>(14件)</span></a></li>
			<li class="spot"><a href="<?php echo base_url("user/spot");?>"><img src="<?php echo base_url("assets");?>/img/user/top/spot.gif" alt="あなたが登録したスポット" /><span>(42件)</span></a></li>
		</ul>
		<p class="edit"><a href="#edit" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/user/top/edit.gif" alt="登録内容変更" /></a></p>
		<dl id="edit_area">
			<iframe src="./edit/" width="460" height="190"></iframe>
			<p class="close"><a href="#close"><img src="<?php echo base_url("assets");?>/img/common/btn/close.png" alt="CLOSE" /></a></p>
		</dl>
		<!-- //edit_area -->

	</div>
	<!-- //select_area -->

	<div class="container">
		<div class="main">

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
				<!-- //pager -->
				
			</div>
			<!-- //search_info -->

			<div class="entries">

				<div id="map_area">
					<div id="map"></div>
				</div>
				<!-- //maparea -->
				
		
				<div class="list_area" id="pg_spots">
					<div class="list_item pg_spot_temp pg_spot_list" style="display:none;">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="スポット" /></p>
						<div class="photo_area">
							<p><a href="../spot/" class="pg_detail"><img class="pg_image" src="<?php echo base_url("assets");?>/img/common/noimage_s.jpg" alt="" /></a></p>
							<div class="pg_like_count" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
							<dl class="category pg_category">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
								<dd>見る</dd>
							</dl>
						</div>
						<!-- //photo_area -->
			
						<div class="info_area">
							<dl class="maininfo">
								<dt class="pg_name">スポット名スポット名スポット名</dt>
								<dd class="pg_description">当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
							
							<p class="linkbtn"><a href="../spot/" class="mouse_over pg_detail"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット詳細を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
			
				</div>
				<!-- //list_area -->

			</div>
			<!-- //entries -->


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
				<!-- //pager -->
				
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

