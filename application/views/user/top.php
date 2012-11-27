<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets");?>/css/modules/user.css" />

<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?php echo base_url("assets");?>/js/user.js"></script>
	
</head>
<body id="user" class="sec tour">

<?php $this->load->view("contents_header"); ?>
<?php $this->load->view("globalnavi"); ?>

<!-- =============== ↓ページコンテンツ↓ =============== -->
<div class="contents">

	<ul id="breadcrumbs">
		<li><a href="../">トップページ</a></li>
		<li>マイページ</li>
	</ul>
	
	<div id="select_area">
		<ul>
			<li class="tour"><a href="<?php echo base_url("user");?>"><img src="<?php echo base_url("assets");?>/img/user/top/tour.gif" alt="あなたが登録したツアー" /><span>(14件)</span></a></li>
			<li class="spot"><a href="<?php echo base_url("user/spot");?>"><img src="<?php echo base_url("assets");?>/img/user/top/spot.gif" alt="あなたが登録したスポット" /><span>(42件)</span></a></li>
		</ul>
		<p class="edit"><a href="#edit" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/user/top/edit.gif" alt="登録内容変更" /></a></p>
		<dl id="edit_area">
			<iframe src="./edit/" width="460" height="190"></iframe>
			<p class="close"><a href="#close"><img src="<?php echo base_url("assets");?>/img/common/btn/close.png" alt="CLOSE" /></a></p>
		</dl>
		<!-- //edit_area -->
	</div>
	<!-- //select_area -->

	<div class="container">
		<div class="main">

			<div class="search_info">
				<p class="total">検索結果：<em>67</em></p>
				
				<div class="pager">
					<p class="order">
						<select name="order">
							<option value="new">新着順</option>
						</select>
					</p>
				
					<p class="prev"><a href="">前へ</a></p>
					<ul>
						<li class="select">1</li>
						<li><a href="">2</a></li>
						<li><a href="">3</a></li>
						<li><a href="">4</a></li>
						<li><a href="">5</a></li>
						<li>...<a href="">46</a></li>
					</ul>
					<p class="next"><a href="">次へ</a></p>
				</div>
				<!-- //pager -->
				
			</div>
			<!-- //search_info -->

			<div class="entries">

				<div id="map_area">
					<div id="map"></div>
				</div>
				<!-- //maparea -->
				
		
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
							
							<p class="linkbtn"><a href="../tour/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/tourlinkbtn.gif" alt="ツアー内容を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
			
					<div class="list_item">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/tour.png" alt="ツアー" /></p>
						
						<div class="photo_area">
							<p><a href="../tour/"><img src="<?php echo base_url("assets");?>/img/common/noimage_s.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
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
			
							<p class="linkbtn"><a href="../tour/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/tourlinkbtn.gif" alt="ツアー内容を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
			
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
								<dt>ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
			
							<p class="linkbtn"><a href="../tour/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/tourlinkbtn.gif" alt="ツアー内容を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
		
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
			
							<p class="linkbtn"><a href="../tour/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/tourlinkbtn.gif" alt="ツアー内容を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
		
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
								<dt>ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
			
							<p class="linkbtn"><a href="../tour/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/tourlinkbtn.gif" alt="ツアー内容を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
			
					<div class="list_item">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/tour.png" alt="ツアー" /></p>
						
						<div class="photo_area">
							<p><a href="../tour/"><img src="<?php echo base_url("assets");?>/img/common/noimage_s.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
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
			
							<p class="linkbtn"><a href="../tour/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/tourlinkbtn.gif" alt="ツアー内容を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->

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
								<dt>ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
			
							<p class="linkbtn"><a href="../tour/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/tourlinkbtn.gif" alt="ツアー内容を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
		
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
			
							<p class="linkbtn"><a href="../tour/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/tourlinkbtn.gif" alt="ツアー内容を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
		
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
								<dt>ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名ツアー名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
			
							<p class="linkbtn"><a href="../tour/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/tourlinkbtn.gif" alt="ツアー内容を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
			
					<div class="list_item">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/tour.png" alt="ツアー" /></p>
						
						<div class="photo_area">
							<p><a href="../tour/"><img src="<?php echo base_url("assets");?>/img/common/noimage_s.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
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
			
							<p class="linkbtn"><a href="../tour/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/tourlinkbtn.gif" alt="ツアー内容を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->

		
				</div>
				<!-- //list_area -->

			</div>
			<!-- //entries -->


			<div class="search_info">
				<p class="total">検索結果：<em>67</em></p>
				
				<div class="pager">
					<p class="order">
						<select name="order">
							<option value="new">新着順</option>
						</select>
					</p>
				
					<p class="prev"><a href="">前へ</a></p>
					<ul>
						<li class="select">1</li>
						<li><a href="">2</a></li>
						<li><a href="">3</a></li>
						<li><a href="">4</a></li>
						<li><a href="">5</a></li>
						<li>...<a href="">46</a></li>
					</ul>
					<p class="next"><a href="">次へ</a></p>
				</div>
				<!-- //pager -->
				
			</div>
			<!-- //search_info -->


		</div>
		<!-- //main -->
		
	
	
		<div class="side">
		
			<?php $this->load->view("guest/side"); ?>
					
		</div>
		<!-- //side -->

	</div>
	<!-- //container -->


</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->





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
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/user/top.js"></script>
<h2>マイページ</h2>
<div id="pg_tabs">
	<ul>
		<li><a href="#pg_tabs_tour">あなたが登録したツアー</a></li>
		<li><a href="#pg_tabs_spot">あなたが登録したスポット</a></li>
	</ul>
	
	<div id="pg_tabs_tour" class="clearfix">
		<div class="pg_map" style="width:50%; height:600px; float:left;"></div>
		<div style="margin-left: 50%; padding: 5px;">
			<div class="pg_pagenation"></div>
			<p>[<a href="<?php echo base_url("user/tour/form");?>">追加</a>]</p>
			<ul id="pg_tours">
				<li class="pg_tour_list pg_tour_temp" style="display: none;">
					<div>
						<div>
							<img class="pg_image" src="" />
							<div class="pg_like_count fb-like" data-href="<?php echo base_url("spot/show/".$spot["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
						</div>
						<div>
							<p>名称：<span class="pg_name"></span></p>
							<p>参考滞在時間：<span class="pg_stay_time"></span>
						</div>
						<div>
							<p>カテゴリ：<ul class="pg_category"></ul></p>
							<p>タグ<ul class="pg_tags"></ul></p>
						</div>
						<div>
							<p>説明：<span class="pg_description"></span></p>
						</div>
					</div>
					<div class="pg_control">
						<a class="pg_detail" href="">詳細</a>
						<a class="pg_copy" href="">複製</a>
						<a class="pg_edit" href="">編集</a>
						<a class="pg_delete" href="">削除</a>
					</div>
				</li>
			</ul>
		</div>
	</div>

	<div id="pg_tabs_spot" class="clearfix">
		<div class="pg_map" style="width:50%; height:600px; float:left;"></div>
		<div style="margin-left: 50%; padding: 5px;">
			<div class="pg_pagenation"></div>
			<p>[<a href="<?php echo base_url("user/spot/form");?>">追加</a>]</p>
			<ul id="pg_spots">
				<li class="pg_spot_temp" style="display: none;">
					<div>
						<div>
							<img class="pg_image" src="" /><br />
							<div class="pg_like_count fb-like" data-href="" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
						</div>
						<div>
							<p>名称：<span class="pg_name"></span></p>
							<p>参考滞在時間：<ul class="pg_stay_time"></ul>
						</div>
						<div>
							<p>カテゴリ：<span class="pg_category"></span></p>
							<p>タグ<ul class="pg_tags"></ul></p>
						</div>
						<div>
							<p>説明：<span class="pg_description"></span></p>
						</div>
					</div>
					<div>
						<a class="pg_detail" href="">詳細</a>
						<a class="pg_edit" href="">編集</a>
						<a class="pg_delete" href="">削除</a>
					</div>
				</li>
			</ul>
		</div>
	</div>

</div>


