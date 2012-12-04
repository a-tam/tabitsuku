		<div class="search_box">
			<form action="<?php echo base_url("spot/search");?>" method="post">
				<div class="search_setting">
					<p class="setting-title"><img src="<?php echo base_url("assets");?>/img/common/search/title.gif" alt="検索設定" /></p>
					<dl class="keyword">
						<dt><img src="<?php echo base_url("assets");?>/img/common/search/keyword.gif" alt="キーワード" /></dt>
						<dd><input type="text" class="text" name="keyword" value="<?php echo $this->input->get_post("area");?>" /></dd>
					</dl>
					<!-- //keyword -->
					<dl class="category">
						<dt><img src="<?php echo base_url("assets");?>/img/common/search/category.gif" alt="カテゴリ" /></dt>
						<dd>
							<p class="selectbtn"><a href="#categoryselect" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/search/categoryselect.gif" alt="検索カテゴリを選択" /></a></p>
							<!--<p class="selectedCategory"><a href="#close" class="close mouse_over"><img src="<?php echo base_url("assets");?>/img/common/search/close.gif" alt="CLOSE" /></a>見る</p>-->
							<div class="categoryselect">
								<ul>
<?php
$category = $this->Category_model->get_list("");
foreach($category->result_array() as $row):?>
									<li data-category-id="<?php echo $row["id"];?>"><a href=""><?php echo $row["name"];?></a></li>
<?php endforeach;?>
								</ul>
								<p class="close"><a href="#close" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/search/close.png" alt="CLSOE" /></a></p>
								<p class="tri">&nbsp;</p>
							</div>
							<!-- //categoryselect -->
						</dd>
					</dl>
					<!-- //category -->
					<dl class="type">
						<dt><img src="<?php echo base_url("assets");?>/img/common/search/type.gif" alt="タイプ" /></dt>
						<dd>
							<ul>
								<li><input type="radio" name="type" value="tour" id="searchbox-tour" /><label for="searchbox-tour">ツアー</label></li>
								<li><input type="radio" name="type" value="spot" id="searchbox-spot" /><label for="searchbox-spot">スポット</label></li>
							</ul>
						</dd>
					</dl>
					<!-- //type -->
				</div>
				<!-- //search_setting -->
				<dl class="search-btn">
					<dt><img src="<?php echo base_url("assets");?>/img/common/search/search.gif" alt="検索" /></dt>
					<dd>
						<ul>
							<li class="mouse_over"><input type="image" src="<?php echo base_url("assets");?>/img/common/search/listsearch.gif" alt="一覧で探す" /></li>
							<li><a href="" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/search/mapsearch.gif" alt="地図で探す" /></a></li>
						</ul>
					</dd>
				</dl>
			</form>
		</div>
		<!-- //search_box -->
