<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets"); ?>/css/modules/tour.css" />

<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/tour.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/guest/tour/show.js"></script>

</head>
<body id="spot" class="sec">

<?php $this->load->view("contents_header"); ?>
<?php $this->load->view("globalnavi"); ?>

<!-- =============== ↓ページコンテンツ↓ =============== -->
<div class="contents">

	<ul id="breadcrumbs">
		<li><a href="../">トップページ</a></li>
		<li><?php echo $data["name"];?></li>
	</ul>


	<div id="map_area">
		<div id="map"></div>
		<div id="route_distance"></div>
		<div>
		<?php if ($this->user_info): ?>
			<?php if ($data["fb_event_permission"] == true): ?>
			<form id="pg_fb_event_add">
				<input type="hidden" name="tour_id" value="<?php echo $data["id"];?>">
				<ul>
					<li>
						<label>イベント名</label>
						<input type="text" name="name" value="<?php echo $data["name"];?>" required="required" />
					</li>
					<li>
						<label>イベント詳細</label>
						<textarea name="description" cols="50" rows="4" required="required"><?php echo $data["description"];?></textarea>
					</li>
					<li>
						<label>開始日時</label>
						<input type="date" name="start_time" required="required" min="<?php echo date("Y-m-d");?>" />
					</li>
					<li>
						<label>終了日時</label>
						<input type="date" name="end_time" min="<?php echo date("Y-m-d");?>" />
					</li>
					<li>
						<label>プライバシー</label>
						<label><input type="radio" name="privacy" value="open" checked="checked">公開</label>
						<label><input type="radio" name="privacy" value="friends">友達</label>
						<label><input type="radio" name="privacy" value="secret">自分のみ</label>
					</li>
				</ul>
				<input type="submit" value="登録" id="pg_fb_event_submit" />
			</form>
			<div id="pg_fb_event_result"></div>
			<?php else:?>
				<a href="<?php echo $data["fb_permission_url"];?>">Facebookのイベント投稿を許可</a>
			<?php endif;?>
		<?php endif;?>
		</div>
	</div>
	<!-- //maparea -->
	
	<div id="detail_area">
		<p class="photo">
			<?php if ($data["image"]) :
				foreach($data["routes"] as $ruote) {
					if ($ruote["id"] == $data["image"]) {
						print '<img src="'.base_url("uploads/spot/middle/".$ruote["image"]["file_name"]).'" alt="" width="265" height="199" />';
						break;
					}
				}
			else: ?>
			<img src="<?php echo base_url("assets");?>/img/common/noimage.jpg" alt="<?php echo $data["name"];?>" width="265" height="199" />
			<?php endif;?>
		</p>
		<div class="info">
			<h2><?php echo $data["name"];?></h2>
			
			<div class="subinfo">
				<dl>
					<dt><img src="<?php echo base_url("assets");?>/img/common/icon/name.gif" alt="作成者" /></dt>
					<dd>田中一郎</dd>
				</dl>
				<dl>
					<dt><img src="<?php echo base_url("assets");?>/img/common/icon/departure.gif" alt="出発地" /></dt>
					<dd>東京駅</dd>
				</dl>
				<dl>
					<dt><img src="<?php echo base_url("assets");?>/img/common/icon/time.gif" alt="時間" /></dt>
					<dd><?php echo $data["stay_time"];?>分</dd>
				</dl>
				<dl class="category">
					<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category_l.gif" alt="CATEGORY" /></dt>
					<dd>
						<ul>
<?php
	foreach($data["category"] as $category_path) :
		$category_names = array();
		preg_match_all("/\d+/", $category_path, $cateogry);
		$tree = array();
		foreach ($cateogry[0] as $key) :
			$tree[] = $data["category_names"][$key];
		endforeach;
?>
							<li><a href=""><?php echo implode(" > ", $tree);?></a></li>
<?php endforeach;?>
						</ul>
					</dd>
				</dl>
				<dl class="tag">
					<dt><img src="<?php echo base_url("assets");?>/img/common/icon/tag_l.gif" alt="タグ" /></dt>
					<dd>
						<ul>
<?php foreach($data["tag_names"] as $tag_key => $tag):?>
							<li><a href=""><?php echo $tag;?></a></li>
<?php endforeach;?>
						</ul>
					</dd>
				</dl>
			</div>
			<!-- //subinfo -->
			
		</div>
		<!-- //info -->
		
		<dl class="comment">
			<dt><img src="<?php echo base_url("assets");?>/img/common/icon/note.gif" alt="説明" /></dt>
			<dd><?php echo $data["description"]?></dd>
		</dl>

		<div class="fb-like" data-href="<?php echo base_url("tour/show/".$data["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
		
		<p class="edit">
			<?php if ($this->user_info):?>
			<a href="<?php echo base_url("user/tour/form/".$data["id"]);?>" class="selectbtn mouse_over">編集する</a>
			<?php endif;?>
		</p>
		
	</div>
	<!-- //detail_area -->


	<div id="route_area">
		<h3><?php echo $data["name"];?><img src="<?php echo base_url("assets");?>/img/tour/route.gif" alt="の行程" /><span>&nbsp;</span></h3>
	
		<div class="routes">
		<?php
		if ($data["routes"]) :
			$time = strtotime($data["start_time"]);
			foreach($data["routes"] as $ruote) :
				$time += $ruote["stay_time"] * 60;
				if ($ruote["id"] == 0): ?>
			<div class="item memo">
				<p class="time"><?php echo date("H:i", $time);?><span class="line">&nbsp;</span></p>
				<dl>
				<dt>メモ</dt>
				<dd><?php echo $ruote["info"]; ?></dd>
				</dl>
			</div>
			<!-- //item --><?php
				else:?>
			<div class="item spot pg_spot" data-spot-id="<?php echo $ruote["id"]?>" data-lat="<?php echo $ruote["lat"];?>" data-lng="<?php echo $ruote["lng"];?>" >
				<p class="time"><?php echo date("H:i", $time);?><span class="line">&nbsp;</span></p>
				<div class="photo_area">
					<p class="photo">
						<?php if ($ruote["image"]) :?>
							<img src="<?php echo base_url("uploads/spot/thumb/".$ruote["image"]["file_name"]);?>" width="98" height="74" alt="" />
						<?php else:?>
							<img src="<?php echo base_url("assets");?>/img/common/noimage.jpg" alt="スポット名スポット名スポット名" width="98" height="74" />
						<?php endif;?>
					</p>
					<div class="fb-like" data-href="<?php echo base_url("spot/show/".$ruote["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
				</div>
				<!-- //photo_area -->
				<div class="info_area">
					<dl class="name">
						<dt><img src="<?php echo base_url("assets");?>/img/tour/name.gif" alt="名称" /></dt>
						<dd><?php echo $ruote["name"]?></dd>
					</dl>
					<dl class="stay">
						<dt><img src="<?php echo base_url("assets");?>/img/tour/staytime.gif" alt="滞在時間" /></dt>
						<dd><?php echo $ruote["defalut_time"];?></dd>
					</dl>
					<dl class="memo">
						<dt><img src="<?php echo base_url("assets");?>/img/tour/memo.gif" alt="一言メモ" /></dt>
						<dd><?php echo $ruote["description"]; ?></dd>
					</dl>
					<p class="linkbtn"><a href="<?php echo base_url("spot/show/".$ruote["id"]);?>" class="mouse_over">スポット詳細をみる</a></p>
					
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //item -->
			<?php endif;?>
		<?php endforeach;?>
	<?php endif;?>
			
		</div>
		<!-- //routes -->
		
			<p class="copy">
				<a href="<?php echo base_url("user/tour/copy/".$data["id"]);?>" class="selectbtn mouse_over pg_copy">コピーしてツアーを作る</a>
				<a href="<?php echo base_url("user/tour/delete/".$data["id"]);?>" class="selectbtn mouse_over pg_delete">削除する</a>
			</p>
		
	</div>
	<!-- //route_area -->

	<?php $this->load->view("guest/search_box", array("mode" => 1));?>

</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->
