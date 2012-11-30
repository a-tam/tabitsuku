<?php $category = $this->Category_model->get_list(""); ?>
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
				<input type="hidden" name="id" id="tour-id" value="<?php echo set_value("id", $data["id"]);?>" readonly="readonly" />
				<dl class="name">
					<dt><img src="<?php echo base_url("assets");?>/img/user/spot/name.gif" alt="名称" /></dt>
					<dd><input type="text" name="name" class="text" id="tour-name" value="<?php echo set_value("name", $data["name"]);?>" /></dd>
				</dl>
				<dl class="description">
					<dt><img src="<?php echo base_url("assets");?>/img/user/spot/description.gif" alt="説明" /></dt>
					<dd><textarea name="description" class="text" id="tour-description"><?php echo set_value("description", $data["description"]);?></textarea></dd>
				</dl>
				<dl class="tag">
					<dt><img src="<?php echo base_url("assets");?>/img/user/spot/tag.gif" alt="タグ" /></dt>
					<dd>
					<ul id="tags" class="inputRounnd">
<?php if ($data["tags"]):?>
<?php foreach($data["tags"] as $tag):?>
						<li><?php echo $tag;?></li>
<?php endforeach;?>
<?php endif;?>
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
<?php foreach($category->result_array() as $row):?>
								<li data-category-id="<?php echo $row["id"];?>"><a href=""><?php echo $row["name"];?></a></li>
<?php endforeach;?>
							</ul>
							<select type="text" name="subcategory_input" maxlength="20" class="text">
							</select>
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
<?php foreach($category->result_array() as $row):?>
						<li data-category-id="<?php echo $row["id"];?>"><a href=""><?php echo $row["name"];?></a></li>
<?php endforeach;?>
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
			<?php $this->load->view("user/tour/spot_item");?>
		
		</div>
		<!-- //list_area -->
		
		<?php $this->load->view("user/tour/memo_item");?>
		
	</div>
	<!-- //spot_search -->

	<div id="tour_make">
		<h2><img src="<?php echo base_url("assets");?>/img/user/tour/tourmaking.gif" alt="3：ツアーを作る" /></h2>
		
		<p class="attention"><img src="<?php echo base_url("assets");?>/img/user/tour/attention_drag.gif" alt="ここにスポットをドラッグしてツアーを作ろう" /></p>
		
		<p class="starttime"><img src="<?php echo base_url("assets");?>/img/user/tour/starttime.gif" alt="スタート時間を設定" /></p>
		<input type="text" name="starttime" id="start_time" class="text" value="<?php echo set_value("start_time", $data["start_time"]);?>"/>
		
		<div class="list_area">
<?php if ($data["routes"]) :?>
	<?php foreach ($data["routes"] as $ruote) :?>
		<?php if ($ruote["id"] == 0): ?>
			<?php $this->load->view("user/tour/memo_item", array("route" => $ruote));?>
		<?php else:?>
			<?php $this->load->view("user/tour/spot_item", array("route" => $ruote));?>
		<?php endif;?>
	<?php endforeach;?>
<?php endif;?>
		
		</div>
		<!-- //list_area -->
		
		<p class="timeline"><img src="<?php echo base_url("assets");?>/img/user/tour/timeline.gif" alt="タイムラインを計算" /></p>
		<p class="totaltime">所要時間：<span id="pg_hour">2</span>時間<span id="pg_minutes">45</span>分</p>
		<a id="pg_tour_center">ルート確認</a>
		<p class="submit mouse_over"><input type="image" id="save_button" src="<?php echo base_url("assets");?>/img/user/tour/savebtn.gif" alt="ツアーを保存する" /></p>
		
	</div>
	<!-- //tour_make -->

	<div id="joint">
		<span class="left">&nbsp;</span>
		<span class="right">&nbsp;</span>
	</div>


</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->

