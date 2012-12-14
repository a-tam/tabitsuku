<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets"); ?>/css/modules/spot.css" />

<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/spot.js"></script>

</head>
<?php if(isset($_GET["mode"]) && $_GET["mode"]=="direct"){ ?>
<body id="spot" class="sec spotdirect">
<?php }else{ ?>
<body id="spot" class="sec">
<?php }?>

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
	
	<div id="detail_area" id="pg_spot_info" data-lat="<?php echo $data["lat"];?>" data-lng="<?php echo $data["lng"];?>" >
		<p class="photo">
			<?php if ($data["image"]) :?>
				<img src="<?php echo base_url("uploads/spot/middle/".$data["image"]["file_name"]);?>" alt="<?php echo $data["name"];?>" width="265" height="199" />
			<?php else :?>
				<img src="<?php echo base_url("assets");?>/img/common/noimage.jpg" alt="<?php echo $data["name"];?>" width="265" height="199" />
			<?php endif;?>
		</p>
		<div class="info">
			<h2><?php echo $data["name"];?></h2>
			
			<div class="subinfo">
				<dl>
					<dt><img src="<?php echo base_url("assets");?>/img/common/icon/name.gif" alt="作成者" /></dt>
					<dd><?php echo $data["owner"];?></dd>
				</dl>
				<dl>
					<dt><img src="<?php echo base_url("assets");?>/img/common/icon/location.gif" alt="場所" /></dt>
					<dd><?php echo $data["prefecture"];?></dd>
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
foreach($data["category"] as $tree):
	preg_match_all("/\d+/", $tree, $category);
	$tree = array();
	foreach($category[0] as $category_id) {
		$tree[] = $data["category_names"][$category_id];
	}
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
<?php foreach($data["tags"] as $tag):?>
							<li><a href=""><?php echo $data["tag_names"][$tag];?></a></li>
<?php endforeach; ?>
						</ul>
					</dd>
				</dl>
			</div>
			<!-- //subinfo -->
			
		</div>
		<!-- //info -->
		
		<dl class="comment">
			<dt><img src="<?php echo base_url("assets");?>/img/common/icon/memo.gif" alt="一言メモ" /></dt>
			<dd><?php echo $data["description"];?></dd>
		</dl>

		<div class="fb-like" data-href="<?php echo base_url("spot/show/".$data["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
		
		<p class="edit">
		<?php if (($this->user_info["id"]) && ($this->user_info["id"] == $data["owner"])):?>
			<a href="<?php echo base_url("user/spot/form/".$data["id"]);?>"><img src="<?php echo base_url("assets");?>/img/spot/edit.gif" alt="編集する" /></a>
		<?php endif;?>
		</p>
		
		
	</div>
	<!-- //detail_area -->


	<section class="othertour">
		<h3><img src="<?php echo base_url("assets");?>/img/spot/tour.gif" alt="このスポットが含まれるツアー" /></h3>
		<div class="list_area">
			<div class="list_item">
				<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/tour.png" alt="ツアー" /></p>
				
				<div class="photo_area">
					<p><a href="../tour/"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
					<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<dl class="category">
						<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
						<dd>見る</dd>
					</dl>
				</div>
				<!-- //photo_area -->
	
				<div class="info_area">
					<dl class="maininfo">
						<dt>ツアー名ツアー名ツアー名</dt>
						<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
					</dl>
					<!-- //maininfo -->
					
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
							<dd>2時間ツアー</dd>
						</dl>
					</div>
					<!-- //subinfo -->
	
					<p class="linkbtn"><a href="../tour/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/tourlinkbtn.gif" alt="ツアー内容を見る"></a></p>
	
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //list_item -->
	
		</div>
		<!-- //list_area -->
	</section>
	<!-- //othertour -->
	


</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->

