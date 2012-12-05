<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets"); ?>/css/modules/top.css" />
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/top.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/top.js"></script>

</head>
<body id="index">
	
<?php $this->load->view("contents_header"); ?>
	
<div id="mainvisual">
	<h2><img src="<?php echo base_url("assets"); ?>/img/top/main_pic.gif" alt="自分だけの旅行プランを作ろう" /></h2>
	<div class="message-area">
		<p><img src="<?php echo base_url("assets"); ?>/img/top/main_txt.gif" alt="たびつくは、みんなで登録したスポットをつないで自分だけの旅行プランを作れるサービスです。" /></p>
		<ul>
			<li><a href="<?php echo base_url("top/about/");?>" class="mouse_over"><img src="<?php echo base_url("assets"); ?>/img/top/about.gif" alt="たびつくとは" /></a></li>
			<li><a href="<?php echo base_url("top/howto/");?>" class="mouse_over"><img src="<?php echo base_url("assets"); ?>/img/top/howto.gif" alt="たびつくの使い方" /></a></li>
		</ul>
	</div>
	<!-- //message-area -->
	
	<div class="login-area">
		<h3><img src="<?php echo base_url("assets"); ?>/img/top/login.gif" alt="ログインはこちらから" /></h3>
		<p class="facebook"><a href="<?php echo $data["fb_login"]; ?>" class="mouse_over"><img src="<?php echo base_url("assets"); ?>/img/common/facebook.gif" alt="Facebookアカウントでログイン"></a></p>
		
		<form action="<?php echo base_url("user/top/login"); ?>" method="post">
		<dl>
			<dt><img src="<?php echo base_url("assets"); ?>/img/top/userid.gif" alt="ユーザーID" /></dt>
			<dd><input type="text" class="text" name="login_id" /></dd>
		</dl>
		<dl>
			<dt><img src="<?php echo base_url("assets"); ?>/img/top/password.gif" alt="パスワード" /></dt>
			<dd><input type="password" class="text" name="password" /></dd>
		</dl>
		<p class="login mouse_over"><input type="image" src="<?php echo base_url("assets"); ?>/img/top/loginbtn.gif" alt="ログイン"/></p>
		<p class="regist"><a href="" class="mouse_over"><img src="<?php echo base_url("assets"); ?>/img/top/registbtn.gif" alt="新規登録" /></a></p>
		</form>
		
	</div>
	<!-- //login-area -->
</div>
<!-- //mainvisual -->

<?php $this->load->view("globalnavi"); ?>


<!-- =============== ↓ページコンテンツ↓ =============== -->
<div class="contents">

	<div class="search_area">
		<dl class="area">
			<dt><img src="<?php echo base_url("assets"); ?>/img/top/areasearch.gif" alt="エリアで探す" /></dt>
			<dd>
				<form method="post">
					<p><input type="text" class="text" name="keyword" /></p>
					<ul>
						<li><input type="radio" name="type" value="tour" id="areasearch-tour" checked="checked"><label for="areasearch-tour">ツアー</label></li>
						<li><input type="radio" name="type" value="spot" id="areasearch-spot"><label for="areasearch-spot">スポット</label></li>
					</ul>
					<p class="submit mouse_over"><input type="image" src="<?php echo base_url("assets"); ?>/img/common/header/searchbtn.gif" alt="検索" /></p>
				</form>
			</dd>
		</dl>
		<!-- //area -->

		<dl class="keyword">
			<dt><img src="<?php echo base_url("assets"); ?>/img/top/keywordsearch.gif" alt="キーワードで探す" /></dt>
			<dd>
				<form method="post">
					<p><input type="text" class="text" name="keyword" /></p>
					<ul>
						<li><input type="radio" name="type" value="tour" id="keywordsearch_tour" checked="checked"><label for="keywordsearch_tour">ツアー</label></li>
						<li><input type="radio" name="type" value="spot" id="keywordsearch_spot"><label for="keywordsearch_spot">スポット</label></li>
					</ul>
					<p class="submit mouse_over"><input type="image" src="<?php echo base_url("assets"); ?>/img/common/header/searchbtn.gif" alt="検索" /></p>
				</form>
			</dd>
		</dl>
		<!-- //area -->

	</div>
	<!-- //search_area -->
	
	<section class="tour">
		<h3><img src="<?php echo base_url("assets"); ?>/img/top/newtour.gif" alt="ツアー新着" /></h3>
		
		<div class="list_area">
			<?php foreach($data["tours"]["list"] as $tour) :?>
			<div class="list_item">
				<p class="icon"><img src="<?php echo base_url("assets"); ?>/img/common/icon/tour.png" alt="ツアー" /></p>
				
				<div class="photo_area">
					<p>
					<a href="<?php echo base_url("tour/show/".$tour["id"]);?>">
						<?php if ($tour["image"]):?>
							<img src="<?php echo base_url("uploads/tour/thumb/".$tour["image"]["file_name"]);?>" width="137" height="104" alt="" /></div>
						<?php else:?>
							<img src="<?php echo base_url("assets"); ?>/img/common/noimage.jpg" width="137" height="104" alt="<?php echo $tour["name"];?>" />
						<?php endif;?>
					</a></p>
					<div class="pg_like_count fb-like" data-href="<?php echo base_url("tour/show/".$tour["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<dl class="category">
<?php
						preg_match_all("/\d+/", $tour["category"], $category);
						$tree = array();
						foreach($category[0] as $category_id):
							$tree[] = $data["tours"]["relation"]["categories"][$category_id];
						endforeach;
?>
								
						<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
						<dd><?php echo implode(" > ", $tree);?></dd>
					</dl>
				</div>
				<!-- //photo_area -->
	
				<div class="info_area">
					<dl class="maininfo">
						<dt><?php echo $tour["name"];?></dt>
						<dd><?php echo mb_substr($tour["description"], 0, 100);?></dd>
					</dl>
					<!-- //maininfo -->
					
					<div class="subinfo">
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/name.gif" alt="作成者" /></dt>
							<dd><?php echo $tour["owner"];?></dd>
						</dl>
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/departure.gif" alt="出発地" /></dt>
							<dd><?php $tour["prefecture"];?></dd>
						</dl>
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/time.gif" alt="時間" /></dt>
							<dd>---</dd>
						</dl>
					</div>
					<!-- //subinfo -->
	
					<p class="linkbtn"><a href="<?php echo base_url("tour/show/".$tour["id"]);?>" class="mouse_over"><img src="<?php echo base_url("assets"); ?>/img/common/btn/tourlinkbtn.gif" alt="ツアー内容を見る"></a></p>
	
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //list_item -->
			<?php endforeach;?>
	
		</div>
		<!-- //list_area -->
	</section>
	<!-- //tour -->

	<section class="spot">
		<h3><img src="<?php echo base_url("assets"); ?>/img/top/newspot.gif" alt="スポット新着" /></h3>
		
		<div class="list_area">
			<?php foreach($data["spots"]["list"] as $spot) :?>
			<div class="list_item">
				<p class="icon"><img src="<?php echo base_url("assets"); ?>/img/common/icon/spot.png" alt="スポット" /></p>
				
				<div class="photo_area">
					<p><a href="<?php echo base_url("spot/show/".$spot["id"]);?>">
						<?php if ($spot["image"]) :?>
						<img src="<?php echo base_url("uploads/spot/thumb/".$spot["image"]["file_name"]);?>" width="137" height="104" alt="<?php echo $data["name"];?>" />
						<?php else: ?>
						<img src="<?php echo base_url("assets");?>/img/common/noimage.jpg" width="137" height="104" alt="<?php echo $data["name"];?>" />
						<?php endif;?>
					</a></p>
					<div class="pg_like_count fb-like" data-href="<?php echo base_url("spot/show/".$spot["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<dl class="category">
						<?php
						$categories = explode(",", $spot["category"]);
						foreach($categories as $tree):
							preg_match_all("/\d+/", $tree, $category);
							$tree = array();
							foreach($category[0] as $category_id) {
								$tree[] = $data["tours"]["relation"]["categories"][$category_id];
							}
						?>
						<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
						<dd><?php echo implode(" > ", $tree);?></dd>
						<?php endforeach;?>
					
					</dl>
				</div>
				<!-- //photo_area -->
	
				<div class="info_area">
					<dl class="maininfo">
						<dt><?php echo $spot["name"];?></dt>
						<dd><?php echo $spot["description"];?></dd>
					</dl>
					<!-- //maininfo -->
					
					<div class="subinfo">
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/name.gif" alt="作成者" /></dt>
							<dd><?php echo $spot["owner"];?></dd>
						</dl>
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/location.gif" alt="場所" /></dt>
							<dd><?php echo $spot["prefecture"];?></dd>
						</dl>
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/time.gif" alt="時間" /></dt>
							<dd><?php echo $spot["stay_time"];?>分</dd>
						</dl>
					</div>
					<!-- //subinfo -->
	
					<p class="linkbtn"><a href="<?php echo base_url("spot/show/".$spot["id"]);?>" class="mouse_over"><img src="<?php echo base_url("assets"); ?>/img/common/btn/spotlinkbtn.gif" alt="スポット詳細を見る"></a></p>
	
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //list_item -->
			<?php endforeach;?>
			
		</div>
		<!-- //list_area -->
	</section>
	<!-- //spot -->


	<section class="special">
		<h3><img src="<?php echo base_url("assets"); ?>/img/top/special.gif" alt="たびつく特集" /></h3>
		
		<div class="list_area">
			<?php foreach($data["topics"]["list"] as $tour) :?>
			<div class="list_item">
				<p class="icon"><img src="<?php echo base_url("assets"); ?>/img/common/icon/tour.png" alt="ツアー" /></p>
				
				<div class="photo_area">
					<p>
					<a href="<?php echo base_url("tour/show/".$tour["id"]);?>">
						<?php if ($tour["image"]):?>
							<img src="<?php echo base_url("uploads/tour/thumb/".$tour["image"]["file_name"]);?>" width="137" height="104" alt="" /></div>
						<?php else:?>
							<img src="<?php echo base_url("assets"); ?>/img/common/noimage.jpg" width="137" height="104" alt="<?php echo $tour["name"];?>" />
						<?php endif;?>
					</a></p>
					<div class="pg_like_count fb-like" data-href="<?php echo base_url("tour/show/".$tour["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
					<dl class="category">
<?php
						preg_match_all("/\d+/", $tour["category"], $category);
						$tree = array();
						foreach($category[0] as $category_id):
							$tree[] = $data["tours"]["relation"]["categories"][$category_id];
						endforeach;
?>
								
						<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
						<dd><?php echo implode(" > ", $tree);?></dd>
					</dl>
				</div>
				<!-- //photo_area -->
	
				<div class="info_area">
					<dl class="maininfo">
						<dt><?php echo $tour["name"];?></dt>
						<dd><?php echo mb_substr($tour["description"], 0, 100);?></dd>
					</dl>
					<!-- //maininfo -->
					
					<div class="subinfo">
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/name.gif" alt="作成者" /></dt>
							<dd><?php echo $tour["owner"];?></dd>
						</dl>
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/departure.gif" alt="出発地" /></dt>
							<dd><?php $tour["prefecture"];?></dd>
						</dl>
						<dl>
							<dt><img src="<?php echo base_url("assets"); ?>/img/common/icon/time.gif" alt="時間" /></dt>
							<dd>---</dd>
						</dl>
					</div>
					<!-- //subinfo -->
	
					<p class="linkbtn"><a href="<?php echo base_url("tour/show/".$tour["id"]);?>" class="mouse_over"><img src="<?php echo base_url("assets"); ?>/img/common/btn/tourlinkbtn.gif" alt="ツアー内容を見る"></a></p>
	
				</div>
				<!-- //info_area -->
				
			</div>
			<!-- //list_item -->
			
			<?php endforeach;?>

		</div>
		<!-- //list_area -->
	</section>
	<!-- //special -->


</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->