<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets"); ?>/css/modules/tour.css" />

<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/tour.js"></script>

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
	</div>
	<!-- //maparea -->
	
	<div id="detail_area">
		<p class="photo">
			<?php if ($data["image"]) :?>
			<img src="<?php echo base_url("uploads/spot/thumb/".$data["image"]["file_name"]);?>" alt="<?php echo $data["name"];?>" />
			<?php else: ?>
			<img src="<?php echo base_url("assets");?>/img/spot/sample.jpg" alt="<?php echo $data["name"];?>" />
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
			<?php if ($this->user_info && ($this->user_info["id"] == $data["owner"])):?>
			<a href="<?php echo base_url("user/tour/copy/".$data["id"]);?>">コピーしてツアーを作る</a>
			<?php else:?>
			<a href="<?php echo base_url("user/tour/form/".$data["id"]);?>"><img src="<?php echo base_url("assets");?>/img/spot/edit.gif" alt="編集する" /></a>
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
					<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
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
						<dd><?php echo $ruote["info"]; ?></dd>
					</dl>
					<p class="detaillink"><a href="#spot" onClick="spotCtl.show('<?php echo base_url("spot/show/".$ruote["id"]);?>');return false;" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット詳細をみる" /></a></p>
					
				</div>
				<!-- //info_area -->
				
				<div class="subinfo">
					<p class="staytime">滞在時間<br /><span><?php echo $ruote["stay_time"];?>分</span></p>
					<p class="tourphoto">ツアー画像<input type="checkbox" name="tourimage" /></p>
				</div>
				<!-- //subinfo -->
				
			</div>
			<!-- //item -->
			<?php endif;?>
		<?php endforeach;?>
	<?php endif;?>
			
		</div>
		<!-- //routes -->
		
		<p class="copy"><a href="../user/tour/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/tour/copy.gif" alt="コピーしてツアーを作る" /></a></p>
		
	</div>
	<!-- //route_area -->

	<?php $this->load->view("guest/search_box_l");?>

</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->
