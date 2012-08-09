<!-- css -->
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/autocomplete/css/jquery.tagit.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets");?>/js/jquery/jpagenate/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/timepicker/jquery.timepicker.css"></script>
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

#toolSpot .timecode, #spotAreaFrameScroll .timecode {
    display:none;
}

.spotList li .spotDetail:hover{
    background-color: #eee;
    
}

.pg_jqui_state_highlight {
    border: ridge 1px #f00;
}

.pg_jqui_state_hover {
    border-color: #ccf;
}

.pg_form_table {
	border: none 0px;
	border-spacing: 0px;
}

.pg_form_table td, .pg_form_table th {
    border: none;
}

.pg_form_table_th {
    white-space: nowrap;
}

</style>
<!-- javascript -->
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

<!-- Add mousewheel plugin (this is optional) -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/jquery.fancybox.css?v=2.0.6" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/helpers/jquery.fancybox-buttons.css?v=1.0.2" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.2" />
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/lightbox/jquery.mousewheel-3.0.6.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/jquery.fancybox.js?v=2.0.6"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.2"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/helpers/jquery.fancybox-media.js?v=1.0.0"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/lightbox/source/helpers/jquery.fancybox-buttons.js?v=1.0.2"></script>
<?php $this->load->view("contents_header"); ?>
<!-- ツアー作成 -->
<div class="pane ui-layout-center">
	<div id="mapAreaFrame" class="center-center">
		<div class="ui-layout-north searchArea">
		<form id="search-map">
		<input type="text" id="search-address" value="" />
		<input type="submit" name="button" value="検索">
		<span id="falledMessage" style="color:red; display:none;">見つかりませんでした。</span>
		</form>
		</div>
		<div id="mapArea" class="ui-layout-center"></div>
	</div>
	<div id="spotAreaFrame" class="center-east">
		<div class="ui-layout-north">
			<div class="ui-layout-north searchArea">
				<div>
					<label for="textfield2">カテゴリ</label>
					<input type="hidden" class="category_val" id="search-category" value="" />
					<input type="text" class="category_label" size="25" value="" readonly="readonly" />
					<input type="button" class="category_clear" value="×" /><br />
					<div id="select-category" class="select-category">&nbsp;</div>
				</div>
				表示<select name="limit" id="limit">
					<option value="10">10</option>
					<option value="100">100</option>
				</select>
				<label for="textfield">キーワード</label>
				<input type="text" name="textfield" id="keyword" size="10"><br />
				ソート:<select name="sort" id="sort">
					<option value="like_count desc">人気順</option>
					<option value="name asc">スポット名</option>
				</select>
				<input type="submit" name="button" id="spotFilterButton" value="検索">
				<div>
				<div id="search-result"><span id="search-count"></span>件中 <span id="start"></span>件 〜 <span id="end"></span>件 表示</div>
				<div id="pagenation"></div>
				</div>
			</div>
		</div>
		<ul id="spotAreaFrameScroll" class="ui-layout-center spotList"></ul>
		<div class="ui-layout-south">
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
		</div>
	</div>
</div>
<div id="tourAreaFrame" class="pane ui-layout-east">
	<div class="ui-layout-north">
		開始時間：
		<label for="start_time"></label>
		<input type="time" name="start_time" id="start_time" size="7" value="<?php echo set_value("start_time", $data["start_time"]);?>">
		<input type="button" id="pg_tour_center" value="ツアーの全体を表示" />
	</div>
	<div id="tourAreaFrameScroll" class="ui-layout-center">
		<span class="timecode">9:00</span>
		<ul class="spotList" style="height:100%; overflow-y: scroll;">
<?php
if ($data["routes"]) :
	foreach ($data["routes"] as $ruote) :
?>
			<li data-spot-id="<?php echo $ruote["id"]?>" data-spot-x="<?php echo $ruote["x"];?>" data-spot-y="<?php echo $ruote["y"];?>" class="spot">
				<div class="spotArea">
					<div class="spotDetail">
<?php if ($ruote["id"] == 0): ?>
						<div class="textArea">
							<div class="timePullDown">
								<textarea cols="20" rows="2" class="spot_info"><?php echo $ruote["info"]; ?></textarea><br />
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
	<div class="ui-layout-south">
		<input type="hidden" name="id" id="guide-id" value="<?php echo set_value("id", $data["id"]);?>" readonly="readonly" />
		<table class="pg_form_table">
			<tr>
				<td class="pg_form_table_th"><label for="textfield2">ツアー名:</label></td>
				<td><input type="text" name="textfield2" id="guide-name" value="<?php echo set_value("name", $data["name"]);?>"></td>
			</tr>
			<tr>
				<td class="pg_form_table_th"><label for="textfield2">カテゴリ:</label></td>
				<td>
					<input type="hidden" class="category_val" id="category" value="<?php echo set_value("category", $data["category"]);?>" />
					<input type="text" class="category_label" size="25" value="" readonly="readonly" />
					<!-- input type="button" class="category_clear" value="×" /><br /> -->
					<div id="select-category" class="select-category">&nbsp;</div>
				</td>
			</tr>
			<tr>
				<td class="pg_form_table_th"><label for="textfield2">説明:</label></td>
				<td><textarea name="textfield2" cols="35" rows="3" id="guide-description"><?php echo set_value("description", $data["description"]);?></textarea></td>
			</tr>
			<tr>
				<td class="pg_form_table_th"><label>タグ:</label></td>
				<td>
					<ul id="tags" style="margin: 0px;">
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
