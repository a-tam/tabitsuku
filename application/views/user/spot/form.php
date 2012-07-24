<!-- css -->
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/autocomplete/css/jquery.tagit.css">
<style type="text/css">
.error {
	color: red;
}
.select-category {
	height: 130px;
	width: 30em;
	position: absolute;
	overflow: auto;
	z-index: 9999999;
	display: none;
	background: #ffc;
	box-shadow: 1px 1px 3px #000;
}
</style>
<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/layout/jquery.layout.min-1.2.0.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/autocomplete/tag-it.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/jstree/jquery.jstree.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.hotkeys.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.dateFormat-1.0.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.url.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/jpagenate/jquery.paginate.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/user/spot.js"></script>
<?php $this->load->view("contents_header"); ?>
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
			<input type="text" name="x" id="spot-x" value="<?php echo set_value("x", $data["x"]);?>" readonly="readonly" />
			<label>経度</label>
			<input type="text" name="y" id="spot-y" value="<?php echo set_value("y", $data["y"]);?>" readonly="readonly" />
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
			<div id="select-category1" class="select-category">&nbsp;</div>
		</div>
		<div>
			<label for="select">カテゴリ２</label>
			<input type="hidden" class="category_val" name="category[]" value="<?php echo set_value("category", $data["category"][1]);?>" />
			<input type="text" class="category_label" size="60" value="" readonly="readonly" />
			<div id="select-category2" class="select-category">&nbsp;</div>
		</div>
		<div>
			<label for="select">カテゴリ３</label>
			<input type="hidden" class="category_val" name="category[]" value="<?php echo set_value("category", $data["category"][2]);?>" />
			<input type="text" class="category_label" size="60" value="" readonly="readonly" />
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
		<div id="headerSaveArea">
		ツアーを保存する
		</div>
	</form>
</div>
<!-- //ツアー作成 -->
