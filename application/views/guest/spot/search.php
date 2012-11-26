<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets"); ?>/css/modules/search.css" />

<!-- javascript -->
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/search.js"></script>

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
		
	
			<div class="search_box">
				<form action="<?php echo base_url("spot/search");?>" method="get">
					<div class="search_setting">
						<p class="setting-title"><img src="<?php echo base_url("assets");?>/img/common/search/title.gif" alt="検索設定" /></p>
						<dl class="keyword">
							<dt><img src="<?php echo base_url("assets");?>/img/common/search/keyword.gif" alt="キーワード" /></dt>
							<dd><input type="text" class="text" name="keyword" /></dd>
						</dl>
						<!-- //keyword -->
						<dl class="category">
							<dt><img src="<?php echo base_url("assets");?>/img/common/search/category.gif" alt="カテゴリ" /></dt>
							<dd>
								<p class="selectbtn"><a href="#categoryselect" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/search/categoryselect.gif" alt="検索カテゴリを選択" /></a></p>
								<!--<p class="selectedCategory"><a href="#close" class="close mouse_over"><img src="<?php echo base_url("assets");?>/img/common/search/close.gif" alt="CLOSE" /></a>見る</p>-->
								<div class="categoryselect">
									<ul>
										<li><a href="">見る</a></li>
										<li><a href="">遊ぶ</a></li>
										<li><a href="">食べる</a></li>
										<li><a href="">宿泊・温泉</a></li>
										<li><a href="">乗り物/乗り場</a></li>
										<li><a href="">買う</a></li>
									</ul>
									<p class="close"><a href="#close" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/search/close.png" alt="CLSOE" /></a></p>
									<p class="tri">&nbsp;</p>
								</div>
								<!-- //categoryselect -->
							</dd>
						</dl>
						<!-- //category -->
						<dl class="type">
							<dt><img src="<?php echo base_url("assets");?>/img/common/search/type.gif" alt="タイプ" /></dt>
							<dd>
								<ul>
									<li><input type="radio" name="type" value="tour" id="searchbox-tour" /><label for="searchbox-tour">ツアー</label></li>
									<li><input type="radio" name="type" value="spot" id="searchbox-spot" /><label for="searchbox-spot">スポット</label></li>
								</ul>
							</dd>
						</dl>
						<!-- //type -->
					</div>
					<!-- //search_setting -->
					<dl class="search-btn">
						<dt><img src="<?php echo base_url("assets");?>/img/common/search/search.gif" alt="検索" /></dt>
						<dd>
							<ul>
								<li class="mouse_over"><input type="image" src="<?php echo base_url("assets");?>/img/common/search/listsearch.gif" alt="一覧で探す" /></li>
								<li><a href="" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/search/mapsearch.gif" alt="地図で探す" /></a></li>
							</ul>
						</dd>
					</dl>
				</form>
			</div>
			<!-- //search_box -->
	
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
		
			<div class="list_area">

				<?php $this->load->view("guest/spot/list"); ?>
				
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