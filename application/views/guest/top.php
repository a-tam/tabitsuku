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
    position: relative;
    border: 1px solid #000;
    margin: 2px;
    padding: 1em;
    border-radius: 0.5em;
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
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/top.js"></script>
<?php $this->load->view("contents_header"); ?>
<h2>たびつく</h2>
<h3><a href="<?php echo base_url("tour/search");?>">新着ツアー</a></h3>
<div>
	<div>
		<?php $this->load->view("guest/tour_list"); ?>
		<p style="clear: both;"><a href="<?php echo base_url("tour/search");?>">一覧をみる</a></p>
	</div>
</div>

<h3><a href="<?php echo base_url("spot/search");?>">新着スポット</a></h3>
<div>
	<div>
		<?php $this->load->view("guest/spot_list"); ?>
		<p style="clear: both;">一覧をみる</p>
	</div>
</div>

<h3>特集</h3>
<div>
	<div>
		<ul>
			<li></li>
		</ul>
		<p>一覧をみる</p>
	</div>
</div>

