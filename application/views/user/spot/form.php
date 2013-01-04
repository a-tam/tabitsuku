<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets"); ?>/css/modules/spotentry.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/autocomplete/css/jquery.tagit.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/timepicker/jquery.timepicker.css">

<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/autocomplete/tag-it.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/user/spot/form.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/timepicker/jquery.timepicker.js"></script>

</head>
<body id="spotentry" class="sec tour">

<?php $this->load->view("contents_header"); ?>
<?php $this->load->view("globalnavi"); ?>
<?php if ($this->phpsession->flashget("saved")):?><div class="pg_notification">[ <?php echo $this->phpsession->flashget("saved");?> ] を保存しました。</div><?php endif;?>


<!-- =============== ↓ページコンテンツ↓ =============== -->
<div class="contents">

	<ul id="breadcrumbs">
		<li><a href="<?php echo base_url("");?>">トップページ</a></li>
		<li><a href="<?php echo base_url("user/top");?>">マイページ</a></li>
		<li><?php if ($data["id"]):?>スポット更新<?php else:?>スポット登録<?php endif;?></li>
	</ul>
	
	<div id="map_area">
		<p id="mapsearch" class="mouse_over">
			<input type="text" class="text" id="search-address" />
			<input type="image" class="btn" id="search-map" src="<?php echo base_url("assets");?>/img/common/header/searchbtn.gif" alt="検索" />
		</p>
		<div id="map"></div>
		<p class="around_spot_message">周辺に <span class="pg_around_number">0</span> 件のスポットが登録されています。<br />既に登録されていないか確認してください。</p><br />
	</div>
	<!-- //maparea -->
	<div id="input_area">
		<h2><img src="<?php echo base_url("assets");?>/img/user/spot/title.gif" alt="スポット登録：基本情報入力" /></h2>
		<form class="input_form" action="<?php echo base_url("user/spot/add");?>" enctype="multipart/form-data" method="post" id="spot-form">
			<input type="hidden" name="id" id="spot-id" value="<?php echo set_value("id", $data["id"]);?>" />
			<input type="hidden" name="zoom" id="spot-zoom" value="<?php echo set_value("zoom", $data["zoom"]);?>" />
			<input type="hidden" name="prefecture" id="spot-prefecture" value="<?php echo set_value("prefecture", $data["prefecture"]);?>" />
			<dl class="name">
				<dt><img src="<?php echo base_url("assets");?>/img/user/spot/name.gif" alt="名称" /></dt>
				<dd><input type="text" name="name" id="spot-name" class="text" value="<?php echo set_value("name", $data["name"]);?>" /><?php echo form_error('name'); ?></dd>
			</dl>
			<dl class="description">
				<dt><img src="<?php echo base_url("assets");?>/img/user/spot/description.gif" alt="説明" /></dt>
				<dd><textarea name="description" id="spot-description" class="textarea"><?php echo set_value("description", $data["description"]);?></textarea><?php echo form_error('description'); ?></dd>
			</dl>
			<dl class="location">
				<dt><img src="<?php echo base_url("assets");?>/img/user/spot/location.gif" alt="場所" /></dt>
				<dd><input type="text" name="address" class="text" id="spot-address" value="<?php echo set_value("address");?>" readonly="readonly" /><?php echo form_error('address'); ?></dd>
			</dl>
			<dl class="latlng">
				<dt><img src="<?php echo base_url("assets");?>/img/user/spot/latlng.gif" alt="緯度・経度" /></dt>
				<dd><ul>
					<li>緯度<input type="text" name="lat" class="text" id="spot-lat" value="<?php echo set_value("lat", $data["lat"]);?>" readonly="readonly" /><?php echo form_error('lat'); ?></li>
					<li>経度<input type="text" name="lng" class="text" id="spot-lng" value="<?php echo set_value("lng", $data["lng"]);?>" readonly="readonly" /><?php echo form_error('lng'); ?></li>
				</ul></dd>
			</dl>
			<dl class="stay_time">
				<dt>滞在時間</dt>
				<dd>
					<select name="stay_time" class="text">
<?php for($t=0; $t<24*4; $t++):?>
						<option value="<?php echo $t*15;?>"<?php if ($t * 15 == set_value("stay_time", $data["stay_time"])):?> selected="selected"<?php endif;?>"><?php echo sprintf("%1$02s:%2$02s", floor($t * 15 / 60), floor(($t % 4) * 15));?></option>
<?php endfor;?>
					</select>
				<?php echo form_error('stay_time'); ?>
				</dd>
			</dl>
			<dl class="tag">
				<dt><img src="<?php echo base_url("assets");?>/img/user/spot/tag.gif" alt="タグ" /></dt>
				<dd><ul id="tags">
				<?php if ($data["tags"]):?>
<?php foreach($data["tags"]["name"] as $tag):?>
						<li><?php echo $tag;?></li>
<?php endforeach;?>
<?php endif;?>
				</ul><?php echo form_error('tags'); ?></dd>
			</dl>
			<dl class="category">
				<dt><img src="<?php echo base_url("assets");?>/img/user/spot/category.gif" alt="カテゴリ" /></dt>
				<dd>
					<ul class="categories">
<?php
$category = $this->Category_model->get_list("");
for($i = 0; $i < 3; $i++):?>
							<li class="category<?php echo $i+1;?>">
<?php
	$category_names = array();
	if ($data["category"][$i]):
		preg_match_all("/\d+/", $data["category"][$i], $cateogry);
		foreach ($cateogry[0] as $key) {
			$category_names[] = $data["category_names"][$key];
		}
?>
								<a href="#add" class="mouse_over category_add" style="display:none;"><img src="<?php echo base_url("assets");?>/img/user/spot/addbtn.gif" alt="カテゴリを追加" /></a>
								<input type="hidden" name="category[]" value="<?php echo $data["category"][$i];?>" class="maincategory" />
								<p class="selectedCategory">
									<a href="#close" class="close mouse_over"><img src="<?php echo base_url("assets");?>/img/common/search/close.gif" alt="CLOSE" /></a><?php echo implode(" : ", $category_names);?></p>
	<?php else:?>
								<a href="#add" class="mouse_over category_add"><img src="<?php echo base_url("assets");?>/img/user/spot/addbtn.gif" alt="カテゴリを追加" /></a>
	<?php endif;?>
							</li>
<?php endfor;?>
					</ul><?php echo form_error('category'); ?>
					<div class="categoryselect">
						<ul>
<?php foreach($category->result_array() as $row):?>
							<li data-category-id="<?php echo $row["id"];?>"><a href=""><?php echo $row["name"];?></a></li>
<?php endforeach;?>
						</ul>
						<select name="subcategory_input" class="text"></select>
						<p class="close"><a href="#close" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/search/close.png" alt="CLSOE" /></a></p>
						<p class="add"><a href="#add" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/icon/add.gif" alt="追加" /></a></p>
						<p class="tri">&nbsp;</p>
					</div>
					<!-- //categoryselect -->

				</dd>
			</dl>
			<dl class="pic">
				<dt><img src="<?php echo base_url("assets");?>/img/user/spot/pic.gif" alt="画像" /></dt>
				<dd><input type="file" name="image" class="upload" />
<?php if ($data["image"]): ?>
<br />
	<?php if (isset($data["image"]["tmp"])):?>
		<a href="<?php echo base_url("uploads/tmp/".$data["image"]["tmp"]["file_name"]);?>" target="_blank">ファイル</a>
	<?php else:?>
		<a href="<?php echo base_url("uploads/spot/middle/".$data["image"]["file_name"]);?>" target="_blank">ファイル</a>
	<?php endif;?>
		<label><input type="checkbox" name="image_delete" value="1" />&nbsp;削除</label>
<?php endif;?>
		<?php echo form_error('image'); ?>
				</dd>
			</dl>
			<p class="submit mouse_over">
			<input type="image" id="headerSaveArea" src="<?php echo base_url("assets");?>/img/user/spot/regist.gif" alt="スポットを登録する" />
			</p>
			
			
		</form>
	</div>
	<!-- //input_area -->


</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->
