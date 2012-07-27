<!-- css -->
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/flick/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets"); ?>/js/jquery/autocomplete/css/jquery.tagit.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets");?>/js/jquery/jpagenate/css/style.css">
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

#toolSpot .timecode {
    display:none;
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
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/user/tour.js"></script>
<?php $this->load->view("contents_header"); ?>
<!-- ツアー作成 -->
<div class="pane ui-layout-center">
	<div id="mapAreaFrame" class="center-center">
		<DIV class="ui-layout-north searchArea">
		<form id="search-map">
		<input type="text" id="search-address" value="" />
		<input type="submit" name="button" value="検索">
		<span id="falledMessage" style="color:red; display:none;">見つかりませんでした。</span>
		</form>
		</DIV>
		<div id="mapArea" class="ui-layout-center"></div>
	</div>
	<div id="spotAreaFrame" class="center-east">
		<DIV class="ui-layout-north">
			スポット一覧
			<DIV class="ui-layout-north searchArea">
				<div>
					<label for="textfield2">カテゴリ</label>
					<input type="hidden" class="category_val" id="search-category" value="" />
					<input type="text" class="category_label" size="30" value="" readonly="readonly" />
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
			</DIV>
		</DIV>
		<ul id="spotAreaFrameScroll" class="ui-layout-center spotList"></ul>
		<DIV class="ui-layout-south">
			<ul id="toolSpot" style="margin-left: 0px; padding-left: 0px;">
			<li data-spot-id="0" style="list-style-type: none;">
				<div class="spotArea">
					<div class="spotDetail" style="width: 215px;">
						メモ
						<div class="textArea">
							<div class="timePullDown">
								<textarea cols="20" rows="2" class="spot_info"></textarea><br />
								滞在時間
								<select name="stay_time" class="stay_time">
									<option value="15">15分</option>
									<option value="30">30分</option>
									<option value="45">45分</option>
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
		</DIV>
	</div>
</div>
<div id="tourAreaFrame" class="pane ui-layout-east">
	<DIV class="ui-layout-north">
		ツアー作成<br>
		スタート時間を設定
		<label for="start_time"></label>
		<input type="time" name="start_time" id="start_time" value="<?php echo set_value("start_time", $data["start_time"]);?>">
	</DIV>
	<div id="tourAreaFrameScroll" class="ui-layout-center">
		<span class="timecode">9:00</span>
		<ul class="spotList">
		<?php if($data["routes"]) :?>
		<?php foreach($data["routes"] as $ruote) :?>
			<li data-spot-id="<?php echo $ruote["id"]?>" class="spot">
				<div class="spotArea">
					<div class="spotDetail">
<?php if ($ruote["id"] == 0): ?>
						<div class="textArea">
							<div class="timePullDown">
								<textarea cols="20" rows="2" class="spot_info"><?php echo $ruote["info"]; ?></textarea><br />
								滞在時間
								<select name="stay_time" class="stay_time">
									<option value="15"<?php if ($ruote["stay_time"] == "15"): ?> selected="selected"<?php endif;?>>15分</option>
									<option value="30"<?php if ($ruote["stay_time"] == "30"): ?> selected="selected"<?php endif;?>>30分</option>
									<option value="45"<?php if ($ruote["stay_time"] == "45"): ?> selected="selected"<?php endif;?>>45分</option>
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
									<option value="15"<?php if ($ruote["stay_time"] == "15"): ?> selected="selected"<?php endif;?>>15分</option>
									<option value="30"<?php if ($ruote["stay_time"] == "30"): ?> selected="selected"<?php endif;?>>30分</option>
									<option value="45"<?php if ($ruote["stay_time"] == "45"): ?> selected="selected"<?php endif;?>>45分</option>
								</select>
							</div>
						</div>
						<div class="spotBtnArea clearfix">
							<span class="bntDetail"><a href="<?php echo base_url("spot/show/".$ruote["id"]);?>">詳細をみる</a></span>
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
	<DIV class="ui-layout-south">
		<p>ツアー情報 </p>
		<p>
			<input type="hidden" name="id" id="guide-id" value="<?php echo set_value("id", $data["id"]);?>" readonly="readonly" />
			<label for="textfield2">ツアー名</label>
			<input type="text" name="textfield2" id="guide-name" value="<?php echo set_value("name", $data["name"]);?>">
			<br>
			<label for="textfield2">ツアー説明</label>
			<textarea name="textfield2" id="guide-description"><?php echo set_value("description", $data["description"]);?></textarea>
			<br>
			<div>
				<label for="textfield2">カテゴリ</label>
				<input type="hidden" class="category_val" id="category" value="<?php echo set_value("category", $data["category"]);?>" />
				<input type="text" class="category_label" size="30" value="" readonly="readonly" />
				<div id="select-category" class="select-category">&nbsp;</div>
			</div>
			<br />
			<label>タグ</label>
			<ul id="tags">
<?php if ($data["tags"]):?>
<?php foreach($data["tags"] as $tag):?>
				<li><?php echo $tag;?></li>
<?php endforeach;?>
<?php endif;?>
			</ul>
		</p>
		<div id="headerSaveArea">
		ツアーを保存する
		</div>
	</DIV>
</div>
<!-- //ツアー作成 -->
