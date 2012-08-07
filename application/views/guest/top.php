<style type="text/css">
#container {
    bottom: 0;
    height: 100%;
    left: 20px;
    min-height: 300px;
    min-width: 600px;
    position: absolute;
    right: 20px;
    top: 40px;
}

.pg_tour {
    float: left;
    width: 320px;
    height: 300px;
    position: relative;
    border: 1px solid #000;
    margin: 2px;
    padding: 1em;
    border-radius: 0.5em;
    list-style-type: none;
}

.pg_tour_right {
    position: absolute;
    top: 10px;
    right: 10px;
}

.pg_spot {
    float: left;
    width: 320px;
    height: 300px;
    position: relative;
    border: 1px solid #000;
    margin: 2px;
    padding: 1em;
    border-radius: 0.5em;
}

.pg_spot_right {
    position: absolute;
    top: 10px;
    right: 10px;
}
</style>
<!--
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/top.js"></script>
 -->
<?php $this->load->view("contents_header"); ?>
<h2>たびつく</h2>
<h3><a href="<?php echo base_url("tour/search");?>">新着ツアー</a></h3>
<div>
	<div>
		<ul id="pg_tours" class="clearfix">
			<?php foreach($data["tours"]["list"] as $tour) :?>
			<li class="pg_tour" id="pg_tour_temp">
				<div>
					<div class="pg_tour_left">
						<?php if ($tour["image"]):?>
						<div class="pg_img"><img src="" alt="" /></div>
						<?php endif;?>
						<div>
							<label>タイトル</label>
							<p class="pg_title"><?php echo $tour["name"];?></p>
						</div>
						<div class="pg_like_count fb-like" data-href="<?php echo base_url("spot/show/".$tour["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
						<div>
							<label>カテゴリ</label>
							<ul class="pg_category">
<?php
								preg_match_all("/\d+/", $tour["category"], $category);
								$tree = array();
								foreach($category[0] as $category_id):
									$tree[] = $data["tours"]["relation"]["categories"][$category_id];
								endforeach;
?>
								<li><?php echo implode(" > ", $tree);?></li>
							</ul>
						</div>
						<div>
							<label>タグ</label>
							<ul class="pg_tags">
								<?php
								preg_match_all("/\d+/", $tour["tags"], $tags);
								foreach($tags[0] as $tag_id):
								?>
								<li><?php echo $data["tours"]["relation"]["tags"][$tag_id];?></li>
								<?php endforeach;?>
							</ul>
						</div>
						<div>
							<label>説明</label>
							<p class="pg_description"><?php echo $tour["description"];?></p>
						</div>
					</div>
					<div class="pg_tour_right">
						<ul class="pg_routes">
							<?php foreach($tour["routes"] as $spot):?>
							<li><?php echo ($spot["spot_id"]) ? $spot["name"] : $spot["info"];?><span>(<?php echo $spot["stay_time"];?>分)</span></li>
							<?php endforeach;?>
						</ul>
					</div>
					<p class="pg_detail" style="clear: both;"><a href="<?php echo base_url("tour/show/".$tour["id"]);?>">詳細</a></p>
					<?php if($this->user_info):?>
					<p class="pg_copy"><a href="<?php echo base_url("user/tour/copy/".$tour["id"]);?>">コピーしてツアーを作る</a></p>
					<?php endif;?>
				</div>
			</li>
			<?php endforeach;?>
		</ul><!-- pg_tours -->
	
		<p style="clear: both;"><a href="<?php echo base_url("tour/search");?>">一覧をみる</a></p>
	</div>
</div>

<h3><a href="<?php echo base_url("spot/search");?>">新着スポット</a></h3>
<div>
	<div>
		<ul id="pg_tours" class="clearfix">
			<?php foreach($data["spots"]["list"] as $spot) :?>
			<li class="pg_tour" id="pg_tour_temp">
				<div>
					<div class="pg_tour_left">
						<div class="pg_img"><img src="" alt="" /></div>
						<div>
							<label>タイトル</label>
							<p class="pg_title"><?php echo $spot["name"];?></p>
						</div>
						<div class="pg_like_count fb-like" data-href="<?php echo base_url("spot/show/".$spot["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
						<div>
							<label>カテゴリ</label>
							<ul class="pg_category">
								<?php
								$categories = explode(",", $spot["category"]);
								foreach($categories as $tree):
									preg_match_all("/\d+/", $tree, $category);
									$tree = array();
									foreach($category[0] as $category_id) {
										$tree[] = $data["tours"]["relation"]["categories"][$category_id];
									}
									?>
								<li><?php echo implode(" > ", $tree);?></li>
								<?php endforeach;?>
							</ul>
						</div>
						<div>
							<label>タグ</label>
							<ul class="pg_tags">
								<?php
								preg_match_all("/\d+/", $spot["tags"], $tags);
								foreach($tags[0] as $tag_id):
								?>
								<li><?php echo $data["spots"]["relation"]["tags"][$tag_id];?></li>
								<?php endforeach;?>
							</ul>
						</div>
						<div>
							<label>説明</label>
							<p class="pg_description"><?php echo $spot["description"];?></p>
						</div>
					</div>
					<p class="pg_detail" style="clear: both;"><a href="<?php echo base_url("spot/show/".$spot["id"]);?>">詳細</a></p>
				</div>
			</li>
			<?php endforeach;?>
		</ul><!-- pg_tours -->
	
		<p>一覧をみる</p>
	</div>
</div>

<h3>特集</h3>
<div>
	<div>
		<ul class="clearfix">
			<?php foreach($data["topics"]["list"] as $tour) :?>
			<li class="pg_tour" id="pg_tour_temp">
				<div>
					<div class="pg_tour_left">
						<?php if ($tour["image"]):?>
						<div class="pg_img"><img src="" alt="" /></div>
						<?php endif;?>
						<div>
							<label>タイトル</label>
							<p class="pg_title"><?php echo $tour["name"];?></p>
						</div>
						<div class="pg_like_count fb-like" data-href="<?php echo base_url("spot/show/".$tour["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
						<div>
							<label>カテゴリ</label>
							<ul class="pg_category">
<?php
								preg_match_all("/\d+/", $tour["category"], $category);
								$tree = array();
								foreach($category[0] as $category_id):
									$tree[] = $data["topics"]["relation"]["categories"][$category_id];
								endforeach;
?>
								<li><?php echo implode(" > ", $tree);?></li>
							</ul>
						</div>
						<div>
							<label>タグ</label>
							<ul class="pg_tags">
								<?php
								preg_match_all("/\d+/", $tour["tags"], $tags);
								foreach($tags[0] as $tag_id):
								?>
								<li><?php echo $data["topics"]["relation"]["tags"][$tag_id];?></li>
								<?php endforeach;?>
							</ul>
						</div>
						<div>
							<label>説明</label>
							<p class="pg_description"><?php echo $tour["description"];?></p>
						</div>
					</div>
					<div class="pg_tour_right">
						<ul class="pg_routes">
							<?php foreach($tour["routes"] as $spot):?>
							<li><?php echo ($spot["spot_id"]) ? $spot["name"] : $spot["info"];?><span>(<?php echo $spot["stay_time"];?>分)</span></li>
							<?php endforeach;?>
						</ul>
					</div>
					<p class="pg_detail" style="clear: both;"><a href="<?php echo base_url("tour/show/".$tour["id"]);?>">詳細</a></p>
					<?php if($this->user_info):?>
					<p class="pg_copy"><a href="<?php echo base_url("user/tour/copy/".$tour["id"]);?>">コピーしてツアーを作る</a></p>
					<?php endif;?>
				</div>
			</li>
			<?php endforeach;?>
		</ul>
		<p>一覧をみる</p>
	</div>
</div>
