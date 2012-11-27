<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets"); ?>/css/modules/spotentry.css" />

<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/spotentry.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/user/spot.js"></script>

</head>
<body id="spotentry" class="sec tour">

<?php $this->load->view("contents_header"); ?>
<?php $this->load->view("globalnavi"); ?>


<!-- =============== ↓ページコンテンツ↓ =============== -->
<div class="contents">

	<ul id="breadcrumbs">
		<li><a href="<?php echo base_url("");?>">トップページ</a></li>
		<li><a href="<?php echo base_url("user/top");?>">マイページ</a></li>
		<li>スポット登録</li>
	</ul>
	
	<div id="map_area">
		<p id="mapsearch" class="mouse_over"><input type="text" class="text" /><input type="image" class="btn" src="<?php echo base_url("assets");?>/img/common/header/searchbtn.gif" alt="検索" /></p>
		<div id="map"></div>
	</div>
	<!-- //maparea -->
	
	<div id="input_area">
		<h2><img src="<?php echo base_url("assets");?>/img/user/spot/title.gif" alt="スポット登録：基本情報入力" /></h2>
		<form class="input_form">
			<dl class="name">
				<dt><img src="<?php echo base_url("assets");?>/img/user/spot/name.gif" alt="名称" /></dt>
				<dd><input type="text" name="name" class="text" value="<?php echo set_value("name", $data["name"]);?>" /></dd>
			</dl>
			<dl class="description">
				<dt><img src="<?php echo base_url("assets");?>/img/user/spot/description.gif" alt="説明" /></dt>
				<dd><textarea type="text" name="description" class="textarea"><?php echo set_value("description", $data["description"]);?></textarea></dd>
			</dl>
			<dl class="location">
				<dt><img src="<?php echo base_url("assets");?>/img/user/spot/location.gif" alt="場所" /></dt>
				<dd><input type="text" name="location" class="text" value="<?php echo set_value("address");?>" readonly="readonly" /></dd>
			</dl>
			<dl class="latlng">
				<dt><img src="<?php echo base_url("assets");?>/img/user/spot/latlng.gif" alt="緯度・経度" /></dt>
				<dd><ul>
					<li>緯度<input type="text" name="lat" class="text" value="<?php echo set_value("lat", $data["lat"]);?>" readonly="readonly" /></li>
					<li>経度<input type="text" name="lng" class="text" value="<?php echo set_value("lng", $data["lng"]);?>" readonly="readonly" /></li>
				</ul></dd>
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
						<input type="text" class="text" maxlength="20" name="subcategory_input" />
						<p class="close"><a href="#close" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/search/close.png" alt="CLSOE" /></a></p>
						<p class="add"><a href="#add" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/icon/add.gif" alt="追加" /></a></p>
						<p class="tri">&nbsp;</p>
					</div>
					<!-- //categoryselect -->

				</dd>
			</dl>
			<dl class="pic">
				<dt><img src="<?php echo base_url("assets");?>/img/user/spot/pic.gif" alt="画像" /></dt>
				<dd><input type="file" name="pic" class="upload" /></dd>
			</dl>
			<p class="submit mouse_over"><input type="image" src="<?php echo base_url("assets");?>/img/user/spot/regist.gif" alt="スポットを登録する" /></p>
			
			
		</form>
	</div>
	<!-- //input_area -->


</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->


<!-- ツアー作成 -->
<div class="pane ui-layout-center">
	<DIV class="ui-layout-north searchArea">
		<form id="search-map">
		<input type="text" id="search-address" value="" />
		<input type="submit" name="button" value="検索">
		<span id="falledMessage" style="color:red; display:none;">見つかりませんでした。</span>
		</form>
	</DIV>
	<div id="mapArea" class="ui-layout-center">
	</div>
</div>
<div id="spotInputForm" class="ui-layout-east">
	<p>スポットを登録 </p>
	<form action="<?php echo base_url("user/spot/add");?>" enctype="multipart/form-data" method="post" id="spot-form">
		<input type="hidden" id="spot-id" value="<?php echo set_value("id", $data["id"]);?>" />
		<p>
			<label>緯度</label>
			<input type="text" name="lat" id="spot-lat" value="<?php echo set_value("lat", $data["lat"]);?>" readonly="readonly" />
			<label>経度</label>
			<input type="text" name="lng" id="spot-lng" value="<?php echo set_value("lng", $data["lng"]);?>" readonly="readonly" />
		</p>
		<p>
			<label for="textfield">住所</label>
			<input type="text" name="address" id="spot-address" size="120" value="<?php echo set_value("address");?>" readonly="readonly" />
		</p>
		<p>
		<input type="button" id="point_confirm" value="近くにある登録済みのスポットを確認します" />
		</p>
		<p>
			<label for="textfield">スポット名称</label>
			<input type="text" name="name" value="<?php echo set_value("name", $data["name"]);?>" /><?php echo form_error('name'); ?>
		</p>
		<p>
			<label for="textfield">詳細</label>
			<textarea name="description" rows="4" cols="60"><?php echo set_value("description", $data["description"]);?></textarea>
		</p>
		<p>
		<label>画像</label>
		<input type="file" name="image" value="" />
<?php if ($data["image"]): ?>
<?php if (isset($data["image"]["tmp"])):?>
		<a href="<?php echo base_url("uploads/tmp/".$data["image"]["tmp"]["file_name"]);?>" target="_blank">登録ファイル</a>
<?php else:?>
		<a href="<?php echo base_url("uploads/spot/origin/".$data["image"]["file_name"]);?>" target="_blank">登録ファイル</a>
<?php endif;?>
		<label><input type="checkbox" name="image_delete" value="1" />&nbsp;削除</label>
<?php endif;?>
		<?php echo form_error('image'); ?>
		</p>
		<div>
			<label for="textfield">参考滞在時間</label>
			<input type="text" name="stay_time" value="<?php echo set_value("stay_time", $data["stay_time"]);?>" />
			<?php echo form_error('stay_time'); ?>
		</div>
		<div>
			<label for="select">カテゴリ１</label>
			<input type="hidden" class="category_val" name="category[]" value="<?php echo set_value("category", $data["category"][0]);?>" />
			<input type="text" class="category_label" size="60" value="" readonly="readonly" />
			<input type="button" class="category_clear" value="×" /><br />
			<div id="select-category1" class="select-category">&nbsp;</div>
		</div>
		<div>
			<label for="select">カテゴリ２</label>
			<input type="hidden" class="category_val" name="category[]" value="<?php echo set_value("category", $data["category"][1]);?>" />
			<input type="text" class="category_label" size="60" value="" readonly="readonly" />
			<input type="button" class="category_clear" value="×" /><br />
			<div id="select-category2" class="select-category">&nbsp;</div>
		</div>
		<div>
			<label for="select">カテゴリ３</label>
			<input type="hidden" class="category_val" name="category[]" value="<?php echo set_value("category", $data["category"][2]);?>" />
			<input type="text" class="category_label" size="60" value="" readonly="readonly" />
			<input type="button" class="category_clear" value="×" /><br />
			<div id="select-category3" class="select-category">&nbsp;</div>
		</div>
		<div>
			<label for="textfield">タグ</label>
			<ul id="tags">
<?php if ($data["tags"]):?>
<?php foreach(set_value("category", $data["tags"]) as $tag):?>
				<li><?php echo $tag;?></li>
<?php endforeach;?>
<?php endif;?>
			</ul>
		</div>
		<div id="headerSaveArea">スポットを保存する</div>
	</form>
</div>
<!-- //ツアー作成 -->
