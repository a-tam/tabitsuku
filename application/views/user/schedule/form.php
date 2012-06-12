
<style type="text/css">
<!--
#editor {
    width: 1260px;
}
#flip {
    width: 970px;
    padding: 10px;
}
#schedule-list {
    border: 2px;
    float: right;
    width: 260px;
    height: 900px;
}

#sortable {
    background-color: #eee;
}

#sortable2 ul{
}

#sortable2 li{
	float:left;
	margin-right:3px;
	margin-bottom:3px;
}

#schedule-list ul{
    list-style: none;
    margin: 0;
    padding: 0;
    margin-bottom: 10px;
}

#schedule-list li{
    margin: 5px; padding: 5px; width: 235px; }


-->
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery/textext/jquery.textext.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery/jstree/jquery.jstree.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery/util/jquery.cookie.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery/util/jquery.hotkeys.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery/jpagenate/jquery.paginate.js"); ?>"></script>
<script type="text/javascript">
var map = null;
$(function() {
	var latlng = new google.maps.LatLng(35.6894875, 139.69170639999993);
	var myOptions = {
		zoom: 10,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	var marker_list = new Array();
	var info_list = new Array();
	
	google.maps.event.addListener(map, 'dragend', function() {
	    setTimeout(search, 300);
	  });

	google.maps.event.addListener(map, 'zoom_changed', function() {
	    setTimeout(search, 300);
	  });

	google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
	    setTimeout(search, 300);
	  });
	  
	
	$("#search").click(function() {
		search();
		return false;
	});

	$("#category,#keyword,#season,#limit").change(function() {
		search();
	});

	function search(page) {
		if (!page) page = 1;
		if (marker_list) {
			marker_list.forEach(function(marker, idx) {
				marker.setMap(null);
			});
		}
		$.ajax({
			url: "<?php echo base_url("user/schedule/query");?>",
			data: {
				category: $("#category").val(),
				keyword: $("#keyword").val(),
				season: $("#season").val(),
				limit: $("#limit").val(),
				page: page,
				ne_x: map.getBounds().getNorthEast().lat(),
				ne_y: map.getBounds().getNorthEast().lng(),
				sw_x: map.getBounds().getSouthWest().lat(),
				sw_y: map.getBounds().getSouthWest().lng()
			},
			dataType: "json",
			success: function(json) {
				$("#sortable2").html("");
				$(json.list).each(function() {
					var html = '<li class="flip" data-flip-id="'+this.id+'">' +
					'<p class="flipTitle">'+this.name+'</p>' +
					'<div class="min60">';
					if (this.image) {
						html += '<img src="<?php echo base_url("uploads/flip/thumb");?>/'+this.image.file_name+'" width="110" height="81" alt="写真" class="flipPhoto">';
					}
					html += '<p class="flipDescription">'+this.description+'</p>' +
					'</div>' +
					'<div class="flipBtnArea">滞在時間：60分 <a href="#">詳細を見る</a></div>' +
					'</li>';
					$("#sortable2").append(html);
					var latlng = new google.maps.LatLng(this.x, this.y);
					var marker = new google.maps.Marker({
						map: map,
						position: latlng,
						title: this.name,
						draggable: false
					});
					marker_list[this.id] = marker;
					info_list[this.id] = new google.maps.InfoWindow({
						content: this.description,
						position: latlng
					});
				});

				$( "#sortable2 li" ).draggable({
					connectToSortable: "#sortable",
					revert: "invalid",
					helper: "clone",
					cursor: "move",
					scroll: true,
					opacity: 0.8,
//					handle: ".flipTitle"
				});

				$( "#sortable" ).sortable({
					revert: true
				});
							
				$("#search-count").text(json.count);
				var page_count = Math.ceil(json.count / $("#limit").val());
				pager(page_count, page);
			}
		});
	}

	function infoWindowOpen(id) {
		$.each(kmlInfoWindow, function(index, infoWindow_) {
			if (id == index) {
				infoWindow_.open(map);
			} else {
				infoWindow_.close(map);
			}
		});
	};
	
	function pager(page_count, now) {
		$("#pagenation").paginate({
			count 		: page_count,
			start 		: now,
			display     : 10,
			border					: true,
			border_color			: '#fff',
			text_color  			: '#fff',
			background_color    	: 'black',
			border_hover_color		: '#ccc',
			text_hover_color  		: '#000',
			background_hover_color	: '#fff',
			images					: false,
			mouse					: 'press',
			onChange				: function(page) {
				search(page);
			}
		});
	}

	$("#select-category").jstree({
		"json_data" : {
			"ajax": {
				"url": "<?php echo base_url("user/category/test"); ?>",
				"data": function(n) {
					return {
						"opration": "get_children",
						"id": n.attr ? n.attr("id").replace("node_", ""): ""
					};
				}
			}
		},
		"plugins" : [ "themes", "json_data", "ui" ]
	}).bind("select_node.jstree", function (e, data) {
		var id = data.rslt.obj.attr("id");
		$("#category").val(id.replace("node_", ""));
	});

	// タグ
	$('#tags').textext({
		plugins : 'tags prompt focus autocomplete ajax arrow',
		tagsItems : <?php echo $data["tags"];?>,
		prompt : 'Add one...',
		ajax : {
			url : '<?php echo base_url("user/tag/search/");?>',
			dataType : 'json',
			cacheResults : true
		}
	});
	
	$("#schedule_save").click(function() {
		var routes = [];
		$("#sortable li.flip").each(function(i, elm) {
			var id = $(elm).attr("data-flip-id");
			routes.push({
				id: id,
				stay_time: 60
			});
		});
		if (routes.length == 0) {
			alert("ルートの指定がありません");
			return false;
		}
		$.ajax({
			url: "<?php echo base_url("user/schedule/add");?>",
			type: "post",
			data: {
				id: $("#guide-id").val(),
				name: $("#guide-name").val(),
				description: $("#guide-description").val(),
				category: $("#category").val(),
				tags: $("#tags").textext()[0]. hiddenInput().val(),
				route: routes
			},
			dataType: "json",
			success: function(json) {
				if (json["schedule_id"]) {
					location.href = "<?php echo base_url("user/top");?>";
				}
			}
		});
		return false;
	});
});



</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/js/jquery/jpagenate/css/style.css");?>" media="screen"/>
<a href="<?php echo base_url(""); ?>">TOP</a> &gt;
<a href="<?php echo base_url("user"); ?>">ユーザー</a> &gt;
<a href="<?php echo base_url("user/schedule/form"); ?>">スケジュール追加</a>
<div id="editor">
<div id="schedule-list">
<form action="<?php echo base_url("user/schedule/add");?>" method="post">
<input type="hidden" name="id" id="guide-id" value="<?php echo set_value("id", $data["id"]);?>" readonly="readonly" />
	<p>
	<label>名前:</label><br />
	<input type="text" id="guide-name" value="<?php echo set_value("name", $data["name"]);?>" />
	</p>
	<p>
	<label>説明:</label><br />
	<textarea id="guide-description" cols="45" rows="7"><?php echo set_value("description", $data["description"]);?></textarea><br />
	</p>
	<p>
	<label>カテゴリ</label>
	<input type="hidden" id="category" value="<?php echo set_value("category", $data["category"]);?>" readonly="readonly" />
	<div id="select-category" style="height: 80px; width: 30em; overflow: auto;"></div>
	</p>
	<p>
	<label>タグ</label>
	<textarea id="tags" rows="1" cols="40"></textarea>
	</p>
	<button id="schedule_save">登録</button>
</form>
<ul id="sortable">
	<li class="ui-state-default">Item 1</li>
	<?php if($data["routes"]) :?>
	<?php foreach($data["routes"] as $ruote) :?>
	<li class="flip ui-draggable" data-flip-id="<?php echo $ruote["id"]?>" style="display: list-item; ">
		<p class="flipTitle"><?php echo $ruote["name"]?></p>
		<div class="min60">
			<?php if ($ruote["image"]): ?>
			<img src="<?php echo base_url("uploads/flip/thumb/".$ruote["image"]["file_name"]);?>" width="110" height="81" alt="写真" class="flipPhoto" />
			<?php endif;?>
			<p class="flipDescription"><?php echo $ruote["description"]?></p>
		</div>
		<div class="flipBtnArea">滞在時間：60分<a href="#">詳細を見る</a></div>
	</li>
	<?php endforeach;?>
	<?php endif;?>
</ul>
</div>
<div id="flip">
<div id="search-form">
<form>
<input type="text" id="place" placeholder="地図" />
<input type="text" id="category" placeholder="カテゴリ" />
<input type="text" id="keyword" placeholder="キーワード、タグ" />
<input type="text" id="season" placeholder="時期" />
<select id="limit">
	<option value="30">30</option>
	<option value="60">60</option>
	<option value="90">90</option>
</select>
<input type="button" id="search" value="検索" />
</form>
</div>
<div id="map_canvas" style="width:960px; height:450px"></div>
<div id="search-result"><span id="search-count"></span>件中 <span id="start"></span>件 〜 <span id="end"></span>件 表示</div>
<div id="pagenation"></div>

<div id="flip_list"></div>
	<ul id="sortable2" class="flipList">
	</ul>
</div>
</div>