<!-- css -->
<style type="text/css">
ul#pg_tours li.pg_tour_list:hover {
    background: #999;
}

#pg_tours {
	display: block;
	height: 700px;
	overflow-y: scroll;
}

#pg_spots {
	display: block;
	height: 700px;
	overflow-y: scroll;
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
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/user/top.js"></script>
<?php $this->load->view("contents_header"); ?>
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


