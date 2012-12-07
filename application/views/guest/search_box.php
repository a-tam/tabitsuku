		<div class="search_box<?php if ($mode == "1"): ?> search_box_l<?php endif;?>">
			<form action="<?php echo base_url("spot/search");?>" method="post">
				<input type="hidden" id="pg_search_keyword" value="<?php echo $this->input->get_post("keyword");?>" />
				<input type="hidden" id="pg_search_order" value="<?php echo $this->input->get_post("order") ?: "created_time";?>" />
				<input type="hidden" id="pg_search_page_number" value="<?php echo $this->input->get_post("page_number") ?: 10;?>" />
				<input type="hidden" id="pg_search_category" value="<?php echo $this->input->get_post("category");?>" />
				<input type="hidden" id="pg_search_owner" value="<?php echo $this->input->get_post("owner");?>" />
				<input type="hidden" id="pg_search_map_select" value="<?php echo $this->input->get_post("map_select");?>" />
				
				<div class="search_setting">
					<p class="setting-title"><img src="<?php echo base_url("assets");?><?php if ($mode == "1"): ?>/img/common/search/title_l.gif<?php else:?>/img/common/search/title.gif<?php endif;?>" alt="検索設定" /></p>
					<dl class="keyword">
						<dt><img src="<?php echo base_url("assets");?>/img/common/search/keyword.gif" alt="キーワード" /></dt>
						<dd><input type="text" class="text" name="keyword" value="<?php echo $this->input->get_post("keyword");?>" />
							<p>
							<select name="order">
								<option value="created_time"<?php if($this->input->get_post("order") == "created_time"):?> selected="selected"<?php endif;?>>新着順</option>
								<option value="like_count"<?php if($this->input->get_post("order") == "like_count"):?> selected="selected"<?php endif;?>>人気順</option>
								<option value="name"<?php if($this->input->get_post("order") == "name"):?> selected="selected"<?php endif;?>>名前順</option>
							</select>
							<select name="page_number">
								<option value="10"<?php if($this->input->get_post("page_number") == 10):?> selected="selected"<?php endif;?>>10</option>
								<option value="25"<?php if($this->input->get_post("page_number") == 25):?> selected="selected"<?php endif;?>>25</option>
								<option value="50"<?php if($this->input->get_post("page_number") == 50):?> selected="selected"<?php endif;?>>50</option>
								<option value="100"<?php if($this->input->get_post("page_number") == 100):?> selected="selected"<?php endif;?>>100</option>
							</select>
							</p>
						</dd>
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
$root_categories = array();
$category = $this->Category_model->get_list("");
$selected_category = $this->input->get_post("category");
foreach($category->result_array() as $row):
	$root_categories[$row["id"]] = $row["name"];
?>
									<li><a data-category-id="<?php echo $row["id"];?>" href=""><?php echo $row["name"];?></a></li>
<?php endforeach;?>
								</ul>
								<p class="close"><a href="#close" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/search/close.png" alt="CLSOE" /></a></p>
								<p class="tri">&nbsp;</p>
							</div>
							<!-- //categoryselect -->
<?php
if ($selected_category) :
	preg_match_all("/\d+/", $selected_category, $selected_cateogry_path);
	$category_names = array();
	foreach($selected_cateogry_path[0] as $selected_cateogry_path_id) {
		$category_names[] = $root_categories[$selected_cateogry_path_id];
	}
?>
							<p class="selectedCategory"><a href="#close" class="close mouse_over">&nbsp;</a><?php echo implode(":", $category_names);?></p>
							<input type="hidden" name="category" value="<?php echo $this->input->get_post("category");?>">
<?php endif;?>
<?php if ($this->user_info): ?>
							<input type="checkbox" name="owner" id="owner" value="mydata"<?php if($this->input->get_post("owner") == "mydata"):?> checked="checked"<?php endif;?> /><label for="owner">自分で登録したデータ</label>
<?php endif;?>
						</dd>
					</dl>
					<!-- //category -->
					<dl class="type">
						<dt><img src="<?php echo base_url("assets");?>/img/common/search/type.gif" alt="タイプ" /></dt>
						<dd>
							<ul>
								<li><input type="radio" name="type" value="tour" id="searchbox-tour"<?php if ($this->input->get_post("type") == "tour"):?> checked="checked"<?php endif;?> /><label for="searchbox-tour">ツアー</label></li>
								<li><input type="radio" name="type" value="spot" id="searchbox-spot"<?php if ($this->input->get_post("type") != "tour"):?> checked="checked"<?php endif;?> /><label for="searchbox-spot">スポット</label></li>
							</ul>
						</dd>
					</dl>
					<!-- //type -->
				</div>
				<!-- //search_setting -->
				<dl class="search-btn">
					<dt><img src="<?php echo base_url("assets");?><?php if ($mode == "1"): ?>/img/common/search/search_l.gif<?php else:?>/img/common/search/search.gif<?php endif;?>" alt="検索" /></dt>
					<dd>
						<ul>
							<li class="mouse_over pg_search_map_btn"><input type="image" src="<?php echo base_url("assets");?>/img/common/search/listsearch.gif" alt="地図で探す" /></li>
						</ul>
						<input type="checkbox" name="map_select" id="map_select" value="1"<?php if ($this->input->get_post("map_select") == "1"):?> checked="checked"<?php endif;?> /><label for="map_select">範囲内検索</label>
					</dd>
				</dl>
			</form>
		</div>
		<!-- //search_box -->