<!-- css -->
<!-- javascript -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/guest/tour/show.js"></script>

<?php $this->load->view("contents_header"); ?>

<h2>ツアー詳細</h2>
<div style="float:left;">
	<div id="pg_map" style="width:300px; height:300px;"></div>
</div>
<div style="float:left;" class="clearfix">
	<div>
		<?php if ($data["image"]) :?>
		<img src="<?php echo base_url("uploads/spot/thumb/".$data["image"]["file_name"]);?>" />
		<?php endif;?>
	</div>
	<table>
		<tr>
			<th>名称</th>
			<td><?php echo $data["name"];?></td>
		</tr>
		<tr>
			<th>滞在時間</th>
			<td><?php echo $data["stay_time"];?>分</td>
		</tr>
		<tr>
			<th>カテゴリ</th>
			<td>
<?php
	preg_match_all("/\d+/", $data["category"], $category);
	$tree = array();
	foreach($category[0] as $category_id) {
		$tree[] = $data["category_names"][$category_id];
	}
?>
				<?php echo implode(" > ", $tree);?>
			</td>
		</tr>
		<tr>
			<th>タグ</th>
			<td>
				<ul>
<?php foreach($data["tag_names"] as $tag_key => $tag):?>
				<li><?php echo $tag;?></li>
<?php endforeach; ?>
				</ul>
			</td>
		</tr>
		<tr>
			<th>説明</th>
			<td><?php echo $data["description"];?></td>
		</tr>
	</table>
	<div class="fb-like" data-href="<?php echo base_url("tour/show/".$data["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
<?php if ($this->user_info):?>
	<a href="<?php echo base_url("user/tour/copy/".$data["id"]);?>">コピーしてツアーを作る</a>
	<?php if ($this->user_info["id"] == $data["owner"]):?>
	<a href="<?php echo base_url("user/tour/form/".$data["id"]);?>">編集</a>
	<?php endif;?>
<?php endif;?>
	<div>
		<span class="timecode"><?php echo $data["start_time"];?></span>
		<ul>
		<?php
		if ($data["routes"]) :
			$time = strtotime($data["start_time"]);
			foreach($data["routes"] as $ruote) :
				$time += $ruote["stay_time"] * 60;
		?>
			<li data-spot-id="<?php echo $ruote["id"]?>" class="spot">
				<div class="spotArea">
					<div class="spotDetail">
<?php if ($ruote["id"] == 0): ?>
						<div class="textArea">
							<div class="timePullDown">
								<?php echo $ruote["info"]; ?><br />
							</div>
						</div>
<?php else: ?>
						<div class="thumbnail">
							<?php if ($ruote["image"]) :?>
							<img src="" width="60" height="60" alt="" />
							<?php endif;?>
						</div>
						<div class="textArea">
							<p class="spotTitle"><?php echo $ruote["name"]?></p>
							<p class="spotDescription"><?php echo $ruote["description"]?></p>
							<div class="timePullDown">
								参考滞在時間：<?php echo $ruote["defalut_time"];?>分
							</div>
						</div>
						<div class="spotBtnArea clearfix">
							<span class="bntDetail"><a href="<?php echo base_url("spot/show/".$ruote["id"]);?>">詳細をみる</a></span>
							<div class="fb-like" data-href="<?php echo base_url("spot/show/".$ruote["id"]);?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false">
							</div>
						</div>
<?php endif;?>
					</div>
					<div>滞在時間：<?php echo $ruote["stay_time"];?>分</div>
				</div>
				<span class="timecode"><?php echo date("H:i", $time);?></span>
			</li>
		<?php endforeach;?>
		<?php endif;?>
		</ul>
	</div>
</div>
