<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets");?>/css/modules/user.css" />

<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>
<script type="text/javascript" src="<?php echo base_url("assets");?>/js/user.js"></script>

</head>
<body id="user" class="sec spot">

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
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="スポット" /></p>
						
						<div class="photo_area">
							<p><a href="../spot/"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
							<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
							<dl class="category">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
								<dd>見る</dd>
							</dl>
						</div>
						<!-- //photo_area -->
			
						<div class="info_area">
							<dl class="maininfo">
								<dt>スポット名スポット名スポット名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
							
							<p class="linkbtn"><a href="../spot/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット詳細を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
			
					<div class="list_item">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="スポット" /></p>
						
						<div class="photo_area">
							<p><a href="../spot/"><img src="<?php echo base_url("assets");?>/img/common/noimage_s.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
							<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
							<dl class="category">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
								<dd>見る</dd>
							</dl>
						</div>
						<!-- //photo_area -->
			
						<div class="info_area">
							<dl class="maininfo">
								<dt>スポット名スポット名スポット名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
			
							<p class="linkbtn"><a href="../spot/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット詳細を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
			
					<div class="list_item">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="スポット" /></p>
						
						<div class="photo_area">
							<p><a href="../spot/"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
							<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
							<dl class="category">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
								<dd>見る</dd>
							</dl>
						</div>
						<!-- //photo_area -->
			
						<div class="info_area">
							<dl class="maininfo">
								<dt>スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
			
							<p class="linkbtn"><a href="../spot/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット詳細を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
		
					<div class="list_item">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="スポット" /></p>
						
						<div class="photo_area">
							<p><a href="../spot/"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
							<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
							<dl class="category">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
								<dd>見る</dd>
							</dl>
						</div>
						<!-- //photo_area -->
			
						<div class="info_area">
							<dl class="maininfo">
								<dt>スポット名スポット名スポット名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
			
							<p class="linkbtn"><a href="../spot/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット詳細を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
		
					<div class="list_item">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="スポット" /></p>
						
						<div class="photo_area">
							<p><a href="../spot/"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
							<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
							<dl class="category">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
								<dd>見る</dd>
							</dl>
						</div>
						<!-- //photo_area -->
			
						<div class="info_area">
							<dl class="maininfo">
								<dt>スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
			
							<p class="linkbtn"><a href="../spot/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット詳細を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
			
					<div class="list_item">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="スポット" /></p>
						
						<div class="photo_area">
							<p><a href="../spot/"><img src="<?php echo base_url("assets");?>/img/common/noimage_s.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
							<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
							<dl class="category">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
								<dd>見る</dd>
							</dl>
						</div>
						<!-- //photo_area -->
			
						<div class="info_area">
							<dl class="maininfo">
								<dt>スポット名スポット名スポット名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
			
							<p class="linkbtn"><a href="../spot/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット詳細を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->

					<div class="list_item">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="スポット" /></p>
						
						<div class="photo_area">
							<p><a href="../spot/"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
							<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
							<dl class="category">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
								<dd>見る</dd>
							</dl>
						</div>
						<!-- //photo_area -->
			
						<div class="info_area">
							<dl class="maininfo">
								<dt>スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
			
							<p class="linkbtn"><a href="../spot/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット詳細を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
		
					<div class="list_item">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="スポット" /></p>
						
						<div class="photo_area">
							<p><a href="../spot/"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
							<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
							<dl class="category">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
								<dd>見る</dd>
							</dl>
						</div>
						<!-- //photo_area -->
			
						<div class="info_area">
							<dl class="maininfo">
								<dt>スポット名スポット名スポット名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
			
							<p class="linkbtn"><a href="../spot/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット詳細を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
		
					<div class="list_item">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="スポット" /></p>
						
						<div class="photo_area">
							<p><a href="../spot/"><img src="<?php echo base_url("assets");?>/img/top/sample.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
							<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
							<dl class="category">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
								<dd>見る</dd>
							</dl>
						</div>
						<!-- //photo_area -->
			
						<div class="info_area">
							<dl class="maininfo">
								<dt>スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名スポット名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
			
							<p class="linkbtn"><a href="../spot/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット詳細を見る"></a></p>
			
						</div>
						<!-- //info_area -->
						
					</div>
					<!-- //list_item -->
			
					<div class="list_item">
						<p class="icon"><img src="<?php echo base_url("assets");?>/img/common/icon/spot.png" alt="スポット" /></p>
						
						<div class="photo_area">
							<p><a href="../spot/"><img src="<?php echo base_url("assets");?>/img/common/noimage_s.jpg" alt="ツアー内容ツアー内容ツアー内容" /></a></p>
							<div class="fb-like" data-href="http://www.google.co.jp/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
							<dl class="category">
								<dt><img src="<?php echo base_url("assets");?>/img/common/icon/category.gif" alt="CATEGORY" /></dt>
								<dd>見る</dd>
							</dl>
						</div>
						<!-- //photo_area -->
			
						<div class="info_area">
							<dl class="maininfo">
								<dt>スポット名スポット名スポット名</dt>
								<dd>当店のメニューは、素材の持ち味を最大限引き出すことを重んじたランチ、ディナーとも「おまかせの１コース」のみ。旬の素材により、メニュー・・・</dd>
							</dl>
							<!-- //maininfo -->
			
							<p class="linkbtn"><a href="../spot/" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/btn/spotlinkbtn.gif" alt="スポット詳細を見る"></a></p>
			
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
			<dl class="taglist group">
				<dt><img src="<?php echo base_url("assets");?>/img/common/side/taglist.gif" alt="タグリスト" /></dt>
				<dd>
					<ul>
						<li><a href=""><em>デート</em></a><p><span>7200</span></p></li>
						<li><a href=""><em>ランチ</em></a><p><span>54</span></p></li>
						<li><a href=""><em>夜景</em></a><p><span>45</span></p></li>
						<li><a href=""><em>長いタグ長いタグ長いタグ長いタグ長いタグ</em></a><p><span>45</span></p></li>
					</ul>
				</dd>
			</dl>
			<!-- //taglist -->
	
			<dl class="category group">
				<dt><img src="<?php echo base_url("assets");?>/img/common/side/category.gif" alt="カテゴリ" /></dt>
				<dd>
					<ul>
						<li><a href=""><em>見る</em></a><p><span>72</span></p></li>
						<li><a href=""><em>遊ぶ</em></a><p><span>54</span></p></li>
						<li><a href=""><em>食べる</em></a><p><span>45</span></p></li>
						<li><a href=""><em>宿泊・温泉</em></a><p><span>45</span></p></li>
						<li><a href=""><em>乗り物/乗り場</em></a><p><span>45</span></p></li>
						<li><a href=""><em>買う</em></a><p><span>45</span></p></li>
					</ul>
				</dd>
			</dl>
			<!-- //category -->
			
			<dl class="rank" id="tourranking">
				<dt><img src="<?php echo base_url("assets");?>/img/common/side/tourranking.gif" alt="ツアーランキング" /></dt>
				<dd>
					<ul>
						<li class="rank1"><a href="">東京グルメ食べ歩きツアー</a></li>
						<li class="rank2"><a href="">屋久島周辺観光</a></li>
						<li class="rank3"><a href="">北海道の大自然</a></li>
						<li class="rank4"><a href="">長いツアー長いツアー長いツアー長いツアー長いツアー</a></li>
						<li class="rank5"><a href="">九州新幹線の旅</a></li>
					</ul>
				</dd>
			</dl>
			<!-- //tourranking -->
	
			<dl class="rank" id="spotranking">
				<dt><img src="<?php echo base_url("assets");?>/img/common/side/spotranking.gif" alt="スポットランキング" /></dt>
				<dd>
					<ul>
						<li class="rank1"><a href="">スカイツリー</a></li>
						<li class="rank2"><a href="">東大寺</a></li>
						<li class="rank3"><a href="">厳島神社</a></li>
						<li class="rank4"><a href="">海遊館</a></li>
						<li class="rank5"><a href="">クッチーナ　イタリアーナ</a></li>
					</ul>
				</dd>
			</dl>
			<!-- //spotranking -->
			
			
		</div>
		<!-- //side -->

	</div>
	<!-- //container -->


</div>
<!-- //contents -->
<!-- =============== ↑ページコンテンツ↑ =============== -->

