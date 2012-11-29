<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets"); ?>/css/modules/tourentry.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/autocomplete/css/jquery.tagit.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/timepicker/jquery.timepicker.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets");?>/js/jquery/jpagenate/css/style.css">

<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/tourentry.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/autocomplete/tag-it.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/timepicker/jquery.timepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.dateFormat-1.0.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/jpagenate/jquery.paginate.js"></script>

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
					<dd>
					<ul id="tags" class="inputRounnd">
						<li>tag1</li>
					</ul>
					</dd>
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
				<p class="search"><input type="text" class="text" id="search-address" /><input type="image" class="btn" src="<?php echo base_url("assets");?>/img/common/header/searchbtn.gif" alt="検索" /></p>
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
				<dd><input type="text" class="text" name="keyword" id="keyword" /></dd>
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
					<select name="order" id="sort">
						<option value="like_count desc">表示順</option>
						<option value="like_count desc">人気順</option>
						<option value="name asc">スポット名</option>
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
			<div class="list_item pg_spot_temp" style="display: none;">
				<p class="pic"><img class="pg_image" src="<?php echo base_url("assets");?>/img/common/noimage_s.jpg" width="54" height="54" alt="スポット名スポット名" /></p>
				<dl>
					<dt class="pg_name">スポット名スポット名</dt>
					<dd class="staytime">参考滞在時間 <span class="pg_stay_time"></span>分</dd>
					<dd class="detaillink"><a href="#spot" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
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
		<input type="text" name="starttime" id="start_time" class="text" />
		
		<div class="list_area">

			<div class="tour_point pg_spot_temp" style="display:none;">
				<p class="time">08:00<span class="line">&nbsp;</span></p>
				<div class="list_item">
					<p class="pic"><img class="pg_image" src="<?php echo base_url("assets");?>/img/top/sample.jpg" width="54" height="54" alt="スポット名スポット名" /></p>
					<dl>
						<dt class="pg_name">スポット名スポット名</dt>
						<dd class="staytime">参考滞在時間 <span class="pg_stay_time"></span>分</dd>
						<dd class="detaillink"><a href="#spot" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlink_s.gif" alt="スポット詳細を見る" /></a></dd>
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
<?php
        $step = 15;
        for ($i = 1; $i <= 24; $i++):
                $stay_time = $i * $step;
                $disp_stay_time = date("H:i", mktime(0, $stay_time, 0, 0, 0, 0));
?>
						<option value="<?php echo $stay_time;?>"><?php echo $disp_stay_time;?></option>
<?php endfor;?>
					</select>
				</p>
			</div>
			<!-- //tour_point -->

			<div class="tour_point pg_memo_temp" style="display:block;">
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
								<p class="staytime">滞在時間
					<select>
<?php
	$step = 15;
	for ($i = 1; $i <= 24; $i++):
		$stay_time = $i * $step;
		$disp_stay_time = date("H:i", mktime(0, $stay_time, 0, 0, 0, 0));
?>
						<option value="<?php echo $stay_time;?>"><?php echo $disp_stay_time;?></option>
<?php endfor;?>
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

