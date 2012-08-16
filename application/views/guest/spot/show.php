<!-- css -->
<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/guest/spot/show.js"></script>

<?php $this->load->view("contents_header"); ?>
<h2>スポット詳細</h2>
<div style="float:left; width:50%;">
	<div id="pg_map" style="width:100%; height:700px;">aaa</div>
</div>
<div style="float:left; width:50%;">
	<div>
		<?php if ($data["image"]) :?>
		<img src="<?php echo base_url("uploads/spot/thumb/".$data["image"]["file_name"]);?>" />
		<?php endif;?>
	</div>
	<table id="pg_spot_info" data-lat="<?php echo $data["lat"];?>" data-lng="<?php echo $data["lng"];?>">
		<tr>
			<th>名称</th>
			<td id="pg_name"><?php echo $data["name"];?></td>
		</tr>
		<tr>
			<th>滞在時間</th>
			<td><?php echo $data["stay_time"];?>分</td>
		</tr>
		<tr>
			<th>カテゴリ</th>
			<td>
				<ul class="pg_category">
<?php
foreach($data["category"] as $tree):
	preg_match_all("/\d+/", $tree, $category);
	$tree = array();
	foreach($category[0] as $category_id) {
		$tree[] = $data["category_names"][$category_id];
	}
?>
					<li><?php echo implode(" > ", $tree);?></li>
<?php endforeach;?>
				</ul>
			</td>
		</tr>
		<tr>
			<th>タグ</th>
			<td>
				<ul>
<?php foreach($data["tags"] as $tag):?>
				<li><?php echo $data["tag_names"][$tag];?></li>
<?php endforeach; ?>
				</ul>
			</td>
		</tr>
		<tr>
			<th>説明</th>
			<td><?php echo $data["description"];?></td>
		</tr>
	</table>
	<div class="fb-like" data-href="<?php echo base_url("spot/show/".$data["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
<?php if ($this->user_info["id"]):?>
	<?php if ($this->user_info["id"] == $data["owner"]):?>
	<a href="<?php echo base_url("user/spot/form/".$data["id"]);?>">編集</a>
	<?php endif;?>
<?php endif;?>
</div>