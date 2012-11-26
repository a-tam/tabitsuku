<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets"); ?>/css/modules/tourentry.css" />

<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/tourentry.js"></script>
	
</head>
<body id="tourentry" class="sec tour">

<?php $this->load->view("contents_header"); ?>
<?php $this->load->view("globalnavi"); ?>


<!-- =============== ↓ページコンテンツ↓ =============== -->
<div class="contents">

	<ul id="breadcrumbs">
		<li><a href="../../">トップページ</a></li>
		<li><a href="../">マイページ</a></li>
		<li>ツアー登録</li>
	</ul>
	
	<p class="howto"><a href="" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/user/tour/howto.gif" alt="ツアーの作り方" /></a></p>
	
	<div id="basic_area">
	
		<div id="input_area">
			<h2><img src="<?php echo base_url("assets");?>/img/user/tour/title.gif" alt="1：ツアー基本情報を入力する" /></h2>
			<form class="input_form">
				<dl class="name">
					<dt><img src="<?php echo base_url("assets");?>/img/user/spot/name.gif" alt="名称" /></dt>
					<dd><input type="text" name="name" class="text" /></dd>
				</dl>
				<dl class="description">
					<dt><img src="<?php echo base_url("assets");?>/img/user/spot/description.gif" alt="説明" /></dt>
					<dd><input type="text" name="description" class="text" /></dd>
				</dl>
				<dl class="tag">
					<dt><img src="<?php echo base_url("assets");?>/img/user/spot/tag.gif" alt="タグ" /></dt>
					<dd><input type="text" name="tag" class="text" /></dd>
				</dl>
				<dl class="category">
					<dt><img src="<?php echo base_url("assets");?>/img/user/spot/category.gif" alt="カテゴリ" /></dt>
					<dd>
						<ul class="categories">
							<li class="category1"><a href="#add" class="mouse_over category_add"><img src="<?php echo base_url("assets");?>/img/user/spot/addbtn.gif" alt="カテゴリを追加" /></a></li>
							<li class="category2"><a href="#add" class="mouse_over category_add"><img src="<?php echo base_url("assets");?>/img/user/spot/addbtn.gif" alt="カテゴリを追加" /></a></li>
							<li class="category3"><a href="#add" class="mouse_over category_add"><img src="<?php echo base_url("assets");?>/img/user/spot/addbtn.gif" alt="カテゴリを追加" /></a></li>
						</ul>
						<div class="categoryselect">
							<ul>
								<li><a href="">見る</a></li>
								<li><a href="">遊ぶ</a></li>
								<li><a href="">食べる</a></li>
								<li><a href="">宿泊・温泉</a></li>
								<li><a href="">乗り物/乗り場</a></li>
								<li><a href="">買う</a></li>
							</ul>
							<input type="text" name="subcategory_input" maxlength="20" class="text" />
							<p class="close"><a href="#close" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/search/close.png" alt="CLSOE" /></a></p>
							<p class="add"><a href="#add" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/icon/add.gif" alt="追加" /></a></p>
							<p class="tri">&nbsp;</p>
						</div>
						<!-- //categoryselect -->
	
					</dd>
				</dl>
				
			</form>
		</div>
		<!-- //input_area -->
	
		<div id="map_area">
			<div id="mapsearch" class="mouse_over">
				<h2><img src="<?php echo base_url("assets");?>/img/user/tour/map.gif" alt="地図を確認" /></h2>
				<p class="search"><input type="text" class="text" /><input type="image" class="btn" src="<?php echo base_url("assets");?>/img/common/header/searchbtn.gif" alt="検索" /></p>
			</div>
			<div id="map"></div>
		</div>
		<!-- //maparea -->
		
	</div>
	<!-- //basic_area -->
	
	<div id="spot_search">
		<h2><img src="<?php echo base_url("assets");?>/img/user/tour/search_title.gif" alt="2：スポットを検索して追加する" /></h2>
		
		<div class="search_box">
			<dl class="keyword">
				<dt><img src="<?php echo base_url("assets");?>/img/user/tour/keyword.gif" alt="キーワード" /></dt>
				<dd><input type="text" class="text" name="keyword" /></dd>
			</dl>
			<dl class="category">
				<dt><img src="<?php echo base_url("assets");?>/img/user/tour/category.gif" alt="カテゴリ" /></dt>
				<dd>
					<p class="selectbtn"><a href="#categoryselect" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/user/tour/category_select.gif" alt="検索カテゴリを選択" /></a></p>
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

			<p class="userspot"><input type="checkbox" name="userspot" id="userspot" /><label for="userspot">登録したスポットから探す</label></p>
			<p class="search-btn mouse_over"><input type="image" src="<?php echo base_url("assets");?>/img/common/header/searchbtn.gif" /></p>
		</div>
		<!-- //search_input -->
		
		<p class="attention"><img src="<?php echo base_url("assets");?>/img/user/tour/attention_routeadd.gif" alt="スポットをドラッグしてルートに追加しよう" /></p>
		
		<div class="search_info">
			<p class="total">検索結果：<em>67件</em></p>
			
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
				</ul>
				<p class="next"><a href="">次へ</a></p>
			</div>
			<!-- //pager -->
			
		</div>
		<!-- //search_info -->
		
		<div class="list_area">
			<div class="list_item">
				<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
				<dl>
					<dt>スポット名スポット名</dt>
					<dd class="staytime">参考滞在時間 60分</dd>
					<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
				</dl>
				<p class="ctlbtn"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
			</div>
			<!-- /list -->

			<div class="list_item">
				<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名" /></p>
				<dl>
					<dt>スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名</dt>
					<dd class="staytime">参考滞在時間 60分</dd>
					<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
				</dl>
				<p class="ctlbtn"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
			</div>
			<!-- /list -->

			<div class="list_item">
				<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
				<dl>
					<dt>スポット名スポット名</dt>
					<dd class="staytime">参考滞在時間 60分</dd>
					<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
				</dl>
				<p class="ctlbtn"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
			</div>
			<!-- /list -->

			<div class="list_item">
				<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
				<dl>
					<dt>スポット名スポット名</dt>
					<dd class="staytime">参考滞在時間 60分</dd>
					<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
				</dl>
				<p class="ctlbtn"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
			</div>
			<!-- /list -->

			<div class="list_item">
				<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
				<dl>
					<dt>スポット名スポット名</dt>
					<dd class="staytime">参考滞在時間 60分</dd>
					<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
				</dl>
				<p class="ctlbtn"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
			</div>
			<!-- /list -->

			<div class="list_item">
				<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
				<dl>
					<dt>スポット名スポット名</dt>
					<dd class="staytime">参考滞在時間 60分</dd>
					<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
				</dl>
				<p class="ctlbtn"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
			</div>
			<!-- /list -->

			<div class="list_item">
				<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
				<dl>
					<dt>スポット名スポット名</dt>
					<dd class="staytime">参考滞在時間 60分</dd>
					<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
				</dl>
				<p class="ctlbtn"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
			</div>
			<!-- /list -->

			<div class="list_item">
				<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名" /></p>
				<dl>
					<dt>スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名</dt>
					<dd class="staytime">参考滞在時間 60分</dd>
					<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
				</dl>
				<p class="ctlbtn"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
			</div>
			<!-- /list -->

			<div class="list_item">
				<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
				<dl>
					<dt>スポット名スポット名</dt>
					<dd class="staytime">参考滞在時間 60分</dd>
					<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
				</dl>
				<p class="ctlbtn"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
			</div>
			<!-- /list -->

			<div class="list_item">
				<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
				<dl>
					<dt>スポット名スポット名</dt>
					<dd class="staytime">参考滞在時間 60分</dd>
					<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
				</dl>
				<p class="ctlbtn"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
			</div>
			<!-- /list -->

			<div class="list_item">
				<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
				<dl>
					<dt>スポット名スポット名</dt>
					<dd class="staytime">参考滞在時間 60分</dd>
					<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
				</dl>
				<p class="ctlbtn"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
			</div>
			<!-- /list -->

			<div class="list_item">
				<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
				<dl>
					<dt>スポット名スポット名</dt>
					<dd class="staytime">参考滞在時間 60分</dd>
					<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
				</dl>
				<p class="ctlbtn"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
			</div>
			<!-- /list -->

		</div>
		<!-- //list_area -->
		
		<div class="memo_item">
			<dl>
				<dt><img src="<?php echo base_url("assets");?>/img/user/tour/memo.gif" alt="メモ" /></dt>
				<dd>メモが必要な場合は追加してください。</dd>
			</dl>
			<p class="ctlbtn"><a href="#add"><img src="<?php echo base_url("assets");?>/img/user/tour/plus.gif" alt="ツアーに追加" /></a></p>
		</div>
		<!-- /memo_item -->
		
	</div>
	<!-- //spot_search -->

	<div id="tour_make">
		<h2><img src="<?php echo base_url("assets");?>/img/user/tour/tourmaking.gif" alt="3：ツアーを作る" /></h2>
		
		<p class="attention"><img src="<?php echo base_url("assets");?>/img/user/tour/attention_drag.gif" alt="ここにスポットをドラッグしてツアーを作ろう" /></p>
		
		<p class="starttime"><img src="<?php echo base_url("assets");?>/img/user/tour/starttime.gif" alt="スタート時間を設定" /></p>
		
		<div class="list_area">

			<div class="tour_point">
				<p class="time"><input type="time" name="starttime" class="text" /><span class="line">&nbsp;</span></p>
				<div class="list_item">
					<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
					<dl>
						<dt>スポット名スポット名</dt>
						<dd class="staytime">参考滞在時間 60分</dd>
						<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
					</dl>
					<div class="ctlbtn">
						<p class="remove"><a href="#remove"><img src="<?php echo base_url("assets");?>/img/user/tour/remove.gif" alt="ツアーから外す" /></a></p>
						<ul class="ctl">
							<li><a href=""><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_up.gif" alt="上へ"></a></li>
							<li><a href=""><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_dn.gif" alt="下へ"></a></li>
						</ul>
					</div>
					
				</div>
				<!-- /list -->
				<p class="staytime">滞在時間
					<select>
						<option value="15">00:15</option>
						<option value="30">00:30</option>
						<option value="45">00:45</option>
						<option value="60">01:00</option>
						<option value="75">01:15</option>
						<option value="90">01:30</option>
						<option value="105">01:45</option>
						<option value="120">02:00</option>
						<option value="135">02:15</option>
						<option value="150">02:30</option>
						<option value="165">02:45</option>
						<option value="180">03:00</option>
						<option value="195">03:15</option>
						<option value="210">03:30</option>
						<option value="225">03:45</option>
						<option value="240">03:00</option>
						<option value="255">04:15</option>
						<option value="270">04:30</option>
						<option value="285">04:45</option>
						<option value="300">05:00</option>
						<option value="315">05:15</option>
						<option value="330">05:30</option>
						<option value="345">05:45</option>
						<option value="360">06:00</option>
					</select>
				</p>
			</div>
			<!-- //tour_point -->

			<div class="tour_point">
				<p class="time">08:00<span class="line">&nbsp;</span></p>
				<div class="list_item">
					<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
					<dl>
						<dt>スポット名スポット名</dt>
						<dd class="staytime">参考滞在時間 60分</dd>
						<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
					</dl>
					<div class="ctlbtn">
						<p class="remove"><a href="#remove"><img src="<?php echo base_url("assets");?>/img/user/tour/remove.gif" alt="ツアーから外す" /></a></p>
						<ul class="ctl">
							<li><a href=""><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_up.gif" alt="上へ"></a></li>
							<li><a href=""><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_dn.gif" alt="下へ"></a></li>
						</ul>
					</div>
					
				</div>
				<!-- /list -->
				<p class="staytime">滞在時間
					<select>
						<option value="15">00:15</option>
						<option value="30">00:30</option>
						<option value="45">00:45</option>
						<option value="60">01:00</option>
						<option value="75">01:15</option>
						<option value="90">01:30</option>
						<option value="105">01:45</option>
						<option value="120">02:00</option>
						<option value="135">02:15</option>
						<option value="150">02:30</option>
						<option value="165">02:45</option>
						<option value="180">03:00</option>
						<option value="195">03:15</option>
						<option value="210">03:30</option>
						<option value="225">03:45</option>
						<option value="240">03:00</option>
						<option value="255">04:15</option>
						<option value="270">04:30</option>
						<option value="285">04:45</option>
						<option value="300">05:00</option>
						<option value="315">05:15</option>
						<option value="330">05:30</option>
						<option value="345">05:45</option>
						<option value="360">06:00</option>
					</select>
				</p>
			</div>
			<!-- //tour_point -->

			<div class="tour_point">
				<p class="time">08:00<span class="line">&nbsp;</span></p>
				<div class="memo_item">
					<dl>
						<dt><img src="<?php echo base_url("assets");?>/img/user/tour/memo.gif" alt="メモ" /></dt>
						<dd><textarea name="memo1"></textarea></dd>
					</dl>
					<div class="ctlbtn">
						<p class="remove"><a href="#remove"><img src="<?php echo base_url("assets");?>/img/user/tour/remove.gif" alt="ツアーから外す" /></a></p>
						<ul class="ctl">
							<li><a href=""><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_up.gif" alt="上へ"></a></li>
							<li><a href=""><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_dn.gif" alt="下へ"></a></li>
						</ul>
					</div>
					
				</div>
				<!-- /list -->
			</div>
			<!-- //tour_point -->

			<div class="tour_point">
				<p class="time">08:00<span class="line">&nbsp;</span></p>
				<div class="list_item">
					<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
					<dl>
						<dt>スポット名スポット名</dt>
						<dd class="staytime">参考滞在時間 60分</dd>
						<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
					</dl>
					<div class="ctlbtn">
						<p class="remove"><a href="#remove"><img src="<?php echo base_url("assets");?>/img/user/tour/remove.gif" alt="ツアーから外す" /></a></p>
						<ul class="ctl">
							<li><a href=""><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_up.gif" alt="上へ"></a></li>
							<li><a href=""><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_dn.gif" alt="下へ"></a></li>
						</ul>
					</div>
					
				</div>
				<!-- /list -->
				<p class="staytime">滞在時間
					<select>
						<option value="15">00:15</option>
						<option value="30">00:30</option>
						<option value="45">00:45</option>
						<option value="60">01:00</option>
						<option value="75">01:15</option>
						<option value="90">01:30</option>
						<option value="105">01:45</option>
						<option value="120">02:00</option>
						<option value="135">02:15</option>
						<option value="150">02:30</option>
						<option value="165">02:45</option>
						<option value="180">03:00</option>
						<option value="195">03:15</option>
						<option value="210">03:30</option>
						<option value="225">03:45</option>
						<option value="240">03:00</option>
						<option value="255">04:15</option>
						<option value="270">04:30</option>
						<option value="285">04:45</option>
						<option value="300">05:00</option>
						<option value="315">05:15</option>
						<option value="330">05:30</option>
						<option value="345">05:45</option>
						<option value="360">06:00</option>
					</select>
				</p>
			</div>
			<!-- //tour_point -->


			<div class="tour_point">
				<p class="time">08:00<span class="line">&nbsp;</span></p>
				<div class="list_item">
					<p class="pic"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="スポット名スポット名" /></p>
					<dl>
						<dt>スポット名スポット名</dt>
						<dd class="staytime">参考滞在時間 60分</dd>
						<dd class="detaillink"><a href="#spot" onClick="spotCtl.show('../../spot/');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
					</dl>
					<div class="ctlbtn">
						<p class="remove"><a href="#remove"><img src="<?php echo base_url("assets");?>/img/user/tour/remove.gif" alt="ツアーから外す" /></a></p>
						<ul class="ctl">
							<li><a href=""><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_up.gif" alt="上へ"></a></li>
							<li><a href=""><img src="<?php echo base_url("assets");?>/img/user/tour/arrow_dn.gif" alt="下へ"></a></li>
						</ul>
					</div>
					
				</div>
				<!-- /list -->
				<p class="staytime">滞在時間
					<select>
						<option value="15">00:15</option>
						<option value="30">00:30</option>
						<option value="45">00:45</option>
						<option value="60">01:00</option>
						<option value="75">01:15</option>
						<option value="90">01:30</option>
						<option value="105">01:45</option>
						<option value="120">02:00</option>
						<option value="135">02:15</option>
						<option value="150">02:30</option>
						<option value="165">02:45</option>
						<option value="180">03:00</option>
						<option value="195">03:15</option>
						<option value="210">03:30</option>
						<option value="225">03:45</option>
						<option value="240">03:00</option>
						<option value="255">04:15</option>
						<option value="270">04:30</option>
						<option value="285">04:45</option>
						<option value="300">05:00</option>
						<option value="315">05:15</option>
						<option value="330">05:30</option>
						<option value="345">05:45</option>
						<option value="360">06:00</option>
					</select>
				</p>
			</div>
			<!-- //tour_point -->


		</div>
		<!-- //list_area -->
		
		<p class="timeline"><img src="<?php echo base_url("assets");?>/img/user/tour/timeline.gif" alt="タイムラインを計算" /></p>
		<p class="totaltime">所要時間：<span>2時間</span><span>45分</span></p>
		<p class="submit mouse_over"><input type="image" src="<?php echo base_url("assets");?>/img/user/tour/savebtn.gif" alt="ツアーを保存する" /></p>
		
	</div>
	<!-- //tour_make -->

	<div id="joint">
		<span class="left">&nbsp;</span>
		<span class="right">&nbsp;</span>
	</div>


</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->





<!-- css
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/autocomplete/css/jquery.tagit.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets");?>/js/jquery/jpagenate/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/timepicker/jquery.timepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/shadow/jquery.shadow.css">

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/layout/jquery.layout-1.2.0.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/autocomplete/tag-it.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/jstree/jquery.jstree.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.hotkeys.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.dateFormat-1.0.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.url.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/jpagenate/jquery.paginate.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/timepicker/jquery.timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/user/tour.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/shadow/jquery.shadow.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/jquery.fancybox.css?v=2.0.6" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2" />
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/lightbox/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/jquery.fancybox.js?v=2.0.6"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/helpers/jquery.fancybox-media.js?v=1.0.0"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2"></script>

 -->





<!-- ツアー作成 -->
<div class="pane ui-layout-center">
	<div id="mapAreaFrame" class="center-center">
		<div class="ui-layout-north searchArea">
		
		
		
		
		
		<form id="search-map">
		<input type="text" id="search-address" value=""  class="search inputRounnd" placeholder="スポットを検索する" style="margin-right:10px;" />
		<input type="submit" name="button" value="検 索">
		<span id="falledMessage" style="color:red; display:none;">見つかりませんでした。</span>
		</form>
		</div>
		<div id="mapArea" class="ui-layout-center"></div>
	</div>
	<div id="spotAreaFrame" class="center-east">
		<div class="ui-layout-north">
			<div class="ui-layout-north searchArea">
								<!-- 上部検索 -->

				
				<div style="padding-bottom:8px;">
			<select name="limit" id="limit" style="margin-right:5px; width:100px;">
					
					<option value="10">表示件数</option>
					<option value="10">10件</option>
					<option value="100">100件</option>
				</select>
				<select name="sort" id="sort" style="width:100px;">
					<option value="like_count desc">表示順</option>
					<option value="like_count desc">人気順</option>
					<option value="name asc">スポット名</option>
				</select>
				</div>
				<div style="padding-bottom:5px;">
					<input type="text" name="textfield" id="keyword" class="inputRounnd" style="width:250px;" placeholder="キーワード">
				</div>
				<div style="padding-bottom:5px;">
					<input type="hidden" class="category_val " id="search-category" value="" />
					<input type="text" class="category_label inputRounnd" size="25" value="" readonly="readonly" placeholder="カテゴリを指定する" />
					<input type="button" class="category_clear" value="×" />
					<div id="select-category" class="select-category">&nbsp;</div>
					<input type="submit" name="button" id="spotFilterButton" value="検 索" style="font-size:100%; margin:0 auto;">

				</div>
				<div>
				<div id="search-result"><span id="search-count"></span>件中 <span id="start"></span>件 〜 <span id="end"></span>件 表示</div>
				<div id="pagenation"></div>
				</div>
				<!-- //上部検索 -->
			</div>
		</div>
		<ul id="spotAreaFrameScroll" class="ui-layout-center spotList" style="z-index:-10">
			<!-- スポットリスト -->
			<!-- //スポットリスト -->
		</ul>
		<div class="ui-layout-south">
		
		<!--  メモスポット -->
			<ul id="toolSpot" style="margin-left: 0px; padding-left: 0px;">
			<li data-spot-id="0" style="list-style-type: none;" class="spot">
				<div class="spotArea">
					<div class="spotDetail" style="width: 215px;">
						メモ
						<div class="textArea">
							<div class="timePullDown">
								<textarea cols="20" rows="2" class="spot_info"></textarea><br />
								滞在時間
								<select name="stay_time" class="stay_time">
<?php
	$step = 15;
	for ($i = 1; $i <= 24; $i++):
		$stay_time = $i * $step;
		$disp_stay_time = date("H:i", mktime(0, $stay_time, 0, 0, 0, 0));
?>
									<option value="<?php echo $stay_time;?>"><?php echo $disp_stay_time;?></option>
<?php endfor;?>
								</select>
							</div>
						</div>
					</div>
					<div class="naviArea">
						<div class="iconAdd">
							<img src="<?php echo base_url("assets"); ?>/img/interface/icon/add16.png" width="16" height="16" alt="add">
						</div>
						<div class="iconUp">
							<img src="<?php echo base_url("assets"); ?>/img/interface/icon/up16.png" width="16" height="16" alt="up">
						</div>
						<div class="iconClose">
							<img src="<?php echo base_url("assets"); ?>/img/interface/icon/close16.png" width="16" height="16" alt="add">
						</div>
						<div class="iconDown">
							<img src="<?php echo base_url("assets"); ?>/img/interface/icon/down16.png" width="16" height="16" alt="add">
						</div>
					</div>
				</div>
				<span class="timecode">9:00</span>
			</li>
			</ul>
		<!--  メモスポット -->
		</div>
	</div>
</div>
<div id="tourAreaFrame" class="pane ui-layout-east">
	<div class="ui-layout-north startTimeArea">
		開始時間：
		<label for="start_time"></label>
		<input type="time" name="start_time" id="start_time" size="7" value="<?php echo set_value("start_time", $data["start_time"]);?>" class="inputRounnd">
		<input type="button" id="pg_tour_center" value="ツアーの全体を表示" />
	</div>
	<div id="tourAreaFrameScroll" class="ui-layout-center">
		<span class="timecode">9:00</span>
		<ul class="spotList" style="height:100%; overflow-y: scroll;">
<?php
if ($data["routes"]) :
	foreach ($data["routes"] as $ruote) :
?>
			<li data-spot-id="<?php echo $ruote["id"]?>" data-spot-lat="<?php echo $ruote["lat"];?>" data-spot-lng="<?php echo $ruote["lng"];?>" class="spot">
				<div class="spotArea">
					<div class="spotDetail">
<?php if ($ruote["id"] == 0): ?>
						<div class="textArea">
							<div class="timePullDown">
								<textarea cols="20" rows="2" class="spot_info inputRounnd"><?php echo $ruote["info"]; ?></textarea><br />
								滞在時間
								<select name="stay_time" class="stay_time">
<?php
	$step = 15;
	for ($i = 1; $i <= 24; $i++):
		$stay_time = $i * $step;
		$disp_stay_time = date("H:i", mktime(0, $stay_time, 0, 0, 0, 0));
?>
									<option value="<?php echo $stay_time;?>"<?php if ($ruote["stay_time"] == $stay_time): ?> selected="selected"<?php endif;?>><?php echo $disp_stay_time;?></option>
<?php endfor;?>
								</select>
							</div>
						</div>
<?php else: ?>
						<div class="thumbnail">
							<?php if ($ruote["image"]) :?>
							<img src="" width="60" height="60" alt="" />
							<?php endif;?>
						</div>
						<div class="textArea">
							<p class="spotTitle"><?php echo $ruote["name"]?></p>
							<p class="spotDescription"><?php echo $ruote["description"]?></p>
							<div class="timePullDown">
								滞在時間
								<select name="stay_time" class="stay_time">
<?php
	$step = 15;
	for ($i = 1; $i <= 24; $i++):
		$stay_time = $i * $step;
		$disp_stay_time = date("H:i", mktime(0, $stay_time, 0, 0, 0, 0));
?>
									<option value="<?php echo $stay_time;?>"<?php if ($ruote["stay_time"] == $stay_time): ?> selected="selected"<?php endif;?>><?php echo $disp_stay_time;?></option>
<?php endfor;?>
								</select>
							</div>
						</div>
						<div class="spotBtnArea clearfix">
							<span class="bntDetail"><a class="various fancybox.ajax" href="<?php echo base_url("spot/show/".$ruote["id"]);?>">詳細をみる</a></span>
							<div class="fb-like" data-href="<?php echo base_url("spot/show/".$ruote["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false">
							</div>
						</div>
<?php endif;?>
					</div>
					<div class="naviArea">
						<div class="iconAdd">
							<img src="<?php echo base_url("assets"); ?>/img/interface/icon/add16.png" width="16" height="16" alt="add">
						</div>
						<div class="iconUp">
							<img src="<?php echo base_url("assets"); ?>/img/interface/icon/up16.png" width="16" height="16" alt="up">
						</div>
						<div class="iconClose">
							<img src="<?php echo base_url("assets"); ?>/img/interface/icon/close16.png" width="16" height="16" alt="add">
						</div>
						<div class="iconDown">
							<img src="<?php echo base_url("assets"); ?>/img/interface/icon/down16.png" width="16" height="16" alt="add">
						</div>
					</div>
				</div>
				<span class="timecode">9:00</span>
			</li>
<?php endforeach;?>
<?php endif;?>
		</ul>
	</div>
	<div class="ui-layout-south tourSaveFormArea">
		<input type="hidden" name="id" id="guide-id" value="<?php echo set_value("id", $data["id"]);?>" readonly="readonly" />
		<table class="pg_form_table">
			<tr>
				<td class="pg_form_table_th"><label for="textfield2">ツアー名:</label></td>
				<td><input type="text" name="textfield2" id="guide-name" value="<?php echo set_value("name", $data["name"]);?>" class="inputRounnd"></td>
			</tr>
			<tr>
				<td class="pg_form_table_th"><label for="textfield2">カテゴリ:</label></td>
				<td>
					<input type="hidden" class="category_val inputRounnd" id="category" value="<?php echo set_value("category", $data["category"]);?>" />
					<input type="text" class="category_label inputRounnd" size="25" value="" readonly="readonly" />
					<!-- input type="button" class="category_clear" value="×" /><br /> -->
					<div id="select-category" class="select-category">&nbsp;</div>
				</td>
			</tr>
			<tr>
				<td class="pg_form_table_th"><label for="textfield2">説明:</label></td>
				<td><textarea name="textfield2" id="guide-description" class="inputRounnd" style="width:190px; height:30px;"><?php echo set_value("description", $data["description"]);?></textarea></td>
			</tr>
			<tr>
				<td class="pg_form_table_th"><label>タグ:</label></td>
				<td>
					<ul id="tags" class="inputRounnd">
<?php if ($data["tags"]):?>
<?php foreach($data["tags"] as $tag):?>
				<li><?php echo $tag;?></li>
<?php endforeach;?>
<?php endif;?>
					</ul>
				</td>
			</tr>
		</table>
		<div id="headerSaveArea">ツアーを保存する</div>
	</div>
</div>
<!-- //ツアー作成 -->
