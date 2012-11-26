<link rel="stylesheet" type="text/css" media="screen,print" href="../css/modules/user.css" />

</head>
<body id="about" class="sec subpage">

<?php $this->load->view("contents_header");?>
<?php $this->load->view("globalnavi");?>


<!-- =============== ↓ページコンテンツ↓ =============== -->
<div class="contents">

	<ul id="breadcrumbs">
		<li><a href="../">トップページ</a></li>
		<li>このサイトについて</li>
	</ul>
	

	<div class="container">
		<div class="main">
		
			<h2><img src="<?php echo base_url("assets");?>/img/about/title.gif" alt="このサイトについて" /></h2>
		
		
			<h3>見出しが入ります。</h3>
			
			<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
			<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
			<p>テキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
			<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
			<p>テキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>


		</div>
		<!-- //main -->
		
	
	
		<div class="side">
		
			<ul>
				<li class="about"><a href="<?php echo base_url("top/about/"); ?>"><img src="<?php echo base_url("assets");?>/img/common/side/about.gif" alt="このサイトについて" /></a></li>
				<li class="howto"><a href="<?php echo base_url("top/howto/"); ?>"><img src="<?php echo base_url("assets");?>/img/common/side/howto.gif" alt="たびつくの使い方" /></a></li>
				<li class="contact"><a href="<?php echo base_url("top/contact/"); ?>"><img src="<?php echo base_url("assets");?>/img/common/side/contact.gif" alt="お問い合わせ" /></a></li>
				<li class="rule"><a href="<?php echo base_url("top/rule/"); ?>"><img src="<?php echo base_url("assets");?>/img/common/side/rule.gif" alt="利用規約" /></a></li>
			</ul>

		</div>
		<!-- //side -->

	</div>
	<!-- //container -->


	<div class="search_box search_box_l">
		<form>
			<div class="search_setting">
				<p class="setting-title"><img src="<?php echo base_url("assets");?>/img/common/search/title_l.gif" alt="検索設定" /></p>
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
				<dt><img src="<?php echo base_url("assets");?>/img/common/search/search_l.gif" alt="検索" /></dt>
				<dd>
					<ul>
						<li><input type="image" src="<?php echo base_url("assets");?>/img/common/search/listsearch.gif" alt="一覧で探す" /></li>
						<li><a href=""><img src="<?php echo base_url("assets");?>/img/common/search/mapsearch.gif" alt="地図で探す" /></a></li>
					</ul>
				</dd>
			</dl>
		</form>
	</div>
	<!-- //search_box -->

</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->