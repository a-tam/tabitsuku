<script type="text/javascript">
$(function() {
	$.ajax({
		url: "<?php echo base_url("api/tour"); ?>",
		data: {
			type: "mydata"
		},
		dataType: "json",
		success: function(json) {
			if (json["count"] > 0) {
				$(json["list"]).each(function() {
					$("#tour_list").append('<li>'+this.name+' [<a href="<?php echo base_url("user/tour/form/");?>/'+this.id+'">編集</a>]</li>');
				});
			}
		}
	});
	
	$.ajax({
		url: "<?php echo base_url("api/spot"); ?>",
		data: {
			type: "mydata"
		},
		dataType: "json",
		success: function(json) {
			if (json["count"] > 0) {
				$(json["list"]).each(function() {
					$("#spot_list").append('<li>'+this.name+' [<a href="<?php echo base_url("user/spot/form/");?>/'+this.id+'">編集</a>]</li>');
				});
			}
		}
	});
	
	// <li>bbb [<a href="<?php echo base_url("user/spot/update");?>">編集</a>]</li>
	
});
</script>

<a href="<?php echo base_url(""); ?>">TOP</a> &gt;
ユーザーページ
<h3>トップページ</h3>

<div>あなたが登録したスケジュール一覧</div>
[<a href="<?php echo base_url("user/tour/form");?>">追加</a>]<br />
<ul id="tour_list">
</ul>

<div>あなたが登録した位置情報一覧</div>
[<a href="<?php echo base_url("user/spot/form");?>">追加</a>]
<ul id="spot_list">
</ul>