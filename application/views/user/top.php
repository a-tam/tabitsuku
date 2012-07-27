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
		<li><a href="#pg_tabs_spot">あなたが登録したスポット</a></li>
		<li><a href="#pg_tabs_tour">あなたが登録したツアー</a></li>
	</ul>
	
	<div id="pg_tabs_spot" class="clearfix">
		<div class="pg_map" style="width:300px; height:300px; float:left; margin-right: 10px;"></div>
		<div class="pagenation"></div>
		<div id="pg_tour_list">
			<p>[<a href="<?php echo base_url("user/spot/form");?>">追加</a>]</p>
			<ul id="spot_list">
			</ul>
		</div>
	</div>

	<div id="pg_tabs_tour" class="clearfix">
		<div class="pg_map" style="width:400px; height:400px; float:left; margin-right: 10px;"></div>
		<div class="pagenation"></div>
		<p>[<a href="<?php echo base_url("user/tour/form");?>">追加</a>]</p>
		<ul id="tour_list">
			<li></li>
		</ul>
	</div>
</div>


