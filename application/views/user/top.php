<script type="text/javascript">
$(function() {
	$.ajax({
		url: "<?php echo base_url("api/schedule"); ?>",
		data: {
			type: "mydata"
		},
		dataType: "json",
		success: function(json) {
			if (json["count"] > 0) {
				$(json["list"]).each(function() {
					$("#schedule_list").append('<li>'+this.name+' [<a href="<?php echo base_url("user/schedule/form/");?>/'+this.id+'">編集</a>]</li>');
				});
			}
		}
	});
	
	$.ajax({
		url: "<?php echo base_url("api/point"); ?>",
		data: {
			type: "mydata"
		},
		dataType: "json",
		success: function(json) {
			if (json["count"] > 0) {
				$(json["list"]).each(function() {
					$("#flip_list").append('<li>'+this.name+' [<a href="<?php echo base_url("user/flip/form/");?>/'+this.id+'">編集</a>]</li>');
				});
			}
		}
	});
	
	// <li>bbb [<a href="<?php echo base_url("user/flip/update");?>">編集</a>]</li>
	
});
</script>

<a href="<?php echo base_url(""); ?>">TOP</a> &gt;
ユーザーページ
<h3>トップページ</h3>

<div>あなたが登録したスケジュール一覧</div>
[<a href="<?php echo base_url("user/schedule/form");?>">追加</a>]<br />
<ul id="schedule_list">
</ul>

<div>あなたが登録した位置情報一覧</div>
[<a href="<?php echo base_url("user/flip/form");?>">追加</a>]
<ul id="flip_list">
</ul>