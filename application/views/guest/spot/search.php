<!-- css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets");?>/js/jquery/jpagenate/css/style.css">
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

.pg_spot {
    float: left;
    width: 320px;
    height: 300px;
    position: relative;
    border: 1px solid #000;
    margin: 2px;
    padding: 1em;
    border-radius: 3px;
}

.pg_spot_right {
    position: absolute;
    top: 10px;
    right: 10px;
}

.pg_spot_right {
    position: absolute;
    top: 10px;
    right: 10px;
}

.select-category {
	height: 130px;
	width: 30em;
	position: absolute;
	overflow: auto;
	z-index: 9999999;
	display: none;
	background: #ffc;
	box-shadow: 1px 1px 3px #000;
}
</style>
<!-- javascript -->
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/jstree/jquery.jstree.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.hotkeys.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.dateFormat-1.0.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.url.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/jpagenate/jquery.paginate.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/guest/spot/search.js"></script>

<?php $this->load->view("contents_header"); ?>
<h2>スポット検索</h2>
<form action="<?php echo base_url("spot/search");?>" method="get">
<fieldset>
<legend>スポット検索</legend>
<div>
	<label for="select">カテゴリ</label>
	<input type="hidden" id="pg_search_category" class="category_val" name="category" value="<?php echo $this->input->get("category");?>" />
	<input type="text" class="category_label" size="60" value="" readonly="readonly" />
	<div id="select-category" class="select-category">
		&nbsp;
	</div>
</div>
<div>
	<label>キーワード</label>
	<input type="text" id="pg_search_keyword" name="keyword" value="<?php echo $this->input->get("keyword");?>" />
	<select name="limit" id="pg_search_limit">
		<option value="10"<?php if($this->input->get("limit") == 10):?> selected="selected"<?php endif;?>>10</option>
		<option value="20"<?php if($this->input->get("limit") == 20):?> selected="selected"<?php endif;?>>20</option>
		<option value="30"<?php if($this->input->get("limit") == 30):?> selected="selected"<?php endif;?>>30</option>
	</select>
	<button>検索</button>
</div>
</fieldset>
</form><!-- Search Form -->

<h3 style="clear: both;">スポット一覧</h3>
<div>
	<div id="pagenation"></div>
	<div>
		<?php $this->load->view("guest/spot/list"); ?>
	</div>
</div>
