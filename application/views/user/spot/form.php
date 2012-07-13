<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:mixi="http://mixi-platform.com/ns#" xmlns:og="http://ogp.me/ns#">
<head>
<meta charset="utf-8" />
<title>たびつく</title>
<link href="<?php echo base_url("assets"); ?>/css/common/import.css" rel="stylesheet" type="text/css">
<!-- java script -->

<!-- IEにHTML5タグを追加する -->
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- IE6でも半透明のPNGを適用する -->
<!--[if IE 6]>
<script src="/_js/DD_belatedPNG/DD_belatedPNG_0.0.8a.js"></script>
<script>DD_belatedPNG.fix('img, .png_bg');</script>
<![endif]-->

<link href="<?php echo base_url("assets"); ?>/js/jquery/jstree/themes/classic/style.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/layout/jquery.layout.min-1.2.0.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/textext/jquery.textext.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/jstree/jquery.jstree.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.hotkeys.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.dateFormat-1.0.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/util/jquery.url.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/jquery/jpagenate/jquery.paginate.js"></script>

<script type="text/javascript">
	
	$(document).ready(function () {
		// レイアウト - ツアー作成
		$('#container').layout({
			east__paneSelector:	".ui-layout-east" ,
			east__size: 500,
			enableCursorHotkey: false,
			closable: false,
			resizable: false
		});
		// レイアウト - スポット検索
		centerLayout = $('div.ui-layout-center').layout({
			center__paneSelector:	".ui-layout-center" ,
			north__paneSelector:	".ui-layout-north" ,
			north__size: 35
		});
		var lat = '<?php echo set_value("x", $data["x"]);?>';
		var lng = '<?php echo set_value("y", $data["y"]);?>';
		var latlng = new google.maps.LatLng(lat, lng);
		var myOptions = {
			zoom: 10,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("mapArea"), myOptions);
		// マーカー表示
		var marker = new google.maps.Marker({
			map: map,
			draggable: true
		});
		marker.setPosition(latlng);
		// MAP検索
		var input = document.getElementById('search-address');
		var autocomplete = new google.maps.places.Autocomplete(input);
		setPosition(latlng);
		autocomplete.bindTo('bounds', map);
		google.maps.event.addListener(autocomplete, 'place_changed', function() {
			var place = autocomplete.getPlace();
			if (place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
			} else {
				map.setCenter(place.geometry.location);
				map.setZoom(17);  // Why 17? Because it looks good.
			}
			//
			var _place = $("#search-place").val();
			var _name = $("#search-name").val();
			var request = {
				location: place.geometry.location,
				radius: '500',
				types: [_place],
				name: _name
			};
//			infowindow = new google.maps.InfoWindow();
//			service = new google.maps.places.PlacesService(map);
//			service.search(request, callback);
			// 検索結果の中央座標設定
			setPosition(place.geometry.location);
		});
		function callback(results, status) {
			if (status == google.maps.places.PlacesServiceStatus.OK) {
				for (var i=0; i < results.length; i++) {
					var place=results[i];
					createMarker(results[i]);
				}
			}
		}

		function createMarker(place) {
			var placeLoc=place.geometry.location;
			var marker=new google.maps.Marker({
				map: map,
				position: new google.maps.LatLng(placeLoc.lat(), placeLoc.lng())
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.setContent(place.name);
				infowindow.open(map, this);
			});
		}
		
		function setPosition(location) {
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode({latLng: location}, function(results, status){
			if(status == google.maps.GeocoderStatus.OK){
			// 正常に処理ができた場合
				$("#spot-address").val(results[0].formatted_address);
			} else {
			// エラーの場合
				$("#spot-address").val("");
			}
			});
			$("#spot-x").val(location.lat());
			$("#spot-y").val(location.lng());
		}

		google.maps.event.addListener(map, 'click', function(event){
			marker.setPosition(event.latLng);
			setPosition(event.latLng);
		});

		$(document).click(function(e) {
			$(".select-category").hide("fast");
		});

		$(".category_label").click(function(e, elm) {
			$(".select-category").hide("fast");
			$(this).next()
			.css("left", $(this).position().left + 10)
			.show("fast");
			e.stopPropagation();
		});

		$(".select-category").click(function(e) {
			e.stopPropagation();
		});
		
		$(".select-category").jstree({
			"json_data" : {
				"ajax": {
					"url": "<?php echo base_url("user/category/tree/970"); ?>",
					"data": function(n) {
						return {
							"opration": "get_children",
							"id": n.attr ? n.attr("id").replace("node_", ""): ""
						};
					}
				}
			},
			"ui" : {
				"initially_select": [ "node_970" ]
			},
			"plugins" : [ "themes", "json_data", "ui" ]
		}).bind("select_node.jstree", function (e, data) {
			$(this).parent().find(".category_label").val($(this).jstree("get_path", data.rslt.obj, false).join(" > "));
			$(this).parent().find(".category_val").val($(this).jstree("get_path", data.rslt.obj, true).join("/").replace(/node_/g, ""));
			$(this).hide();
		});
		
		// タグ
		$('#spot-tags').textext({
			plugins : 'tags prompt focus autocomplete ajax arrow',
			tagsItems : <?php echo $data["tags"];?>,
			prompt : 'Add one...',
			ajax : {
				url : '<?php echo base_url("user/tag/search/");?>',
				dataType : 'json',
				cacheResults : true
			}
		});

		$("#headerSaveArea").click(function() {
			$("#spot-form").submit();
		});
	});
</script>
</HEAD>

<BODY id="makeSpot">
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/ja_JP/all.js#xfbml=1&appId=113756558761728";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="layout">
	<header>
		<div id="headerInner">
			たびつく　TOP - ツアーを作る - マイページ　会員登録　ログイン　ログアウト
		</div>
	</header>
	<div id="container">
		<!-- ツアー作成 -->
		<div class="pane ui-layout-center">
			<DIV class="ui-layout-north searchArea">
				<input type="text" id="search-address" value="" />
				<input type="submit" name="button" id="button" value="検索">
			</DIV>
			<div id="mapArea" class="ui-layout-center">
			</div>
		</div>
		<div id="spotInputForm" class="ui-layout-east">
			<p>スポットを登録 </p>
			<form action="<?php echo base_url("user/spot/add");?>" enctype="multipart/form-data" method="post" id="spot-form">
				<p>
					<label>緯度</label>
					<input type="text" name="x" id="spot-x" value="<?php echo set_value("x", $data["x"]);?>" readonly="readonly" />
					<label>経度</label>
					<input type="text" name="y" id="spot-y" value="<?php echo set_value("y", $data["y"]);?>" readonly="readonly" />
				</p>
				<p>
					<label for="textfield">スポット名称</label>
					<input type="text" name="address" id="spot-address" size="120" value="<?php echo set_value("address");?>" readonly="readonly" />
				</p>
				<p>
					<label for="textfield">スポット名称</label>
					<input type="text" name="name" value="<?php echo set_value("name", $data["name"]);?>" />
				</p>
				<p>
					<label for="textfield">詳細</label>
					<textarea name="description" rows="4" cols="60"><?php echo set_value("description", $data["description"]);?></textarea>
				</p>
				<p>
				<label>画像</label>
				<input type="file" name="image" value="" />
<?php if ($data["image"]): ?>
<?php if (isset($data["image"]["tmp"])):?>
				<a href="<?php echo base_url("uploads/tmp/".$data["image"]["tmp"]["file_name"]);?>" target="_blank">登録ファイル</a>
<?php else:?>
				<a href="<?php echo base_url("uploads/spot/origin/".$data["image"]["file_name"]);?>" target="_blank">登録ファイル</a>
<?php endif;?>
				<label><input type="checkbox" name="image_delete" value="1" />&nbsp;削除</label>
<?php endif;?>
				</p>
				<div>
					<label for="textfield">参考滞在時間</label>
					<input type="text" name="stay_time" value="<?php echo set_value("stay_time", $data["stay_time"]);?>" />
				</div>
				<div>
					<label for="select">カテゴリ１</label>
					<input type="hidden" class="category_val" name="category[]" value="<?php echo set_value("category", $data["category"][0]);?>" />
					<input type="text" class="category_label" size="60" value="<?php echo set_value("category", $data["category"][0]);?>" />
					<div id="select-category1" class="select-category" style="height: 130px; width: 30em; position: absolute; overflow: auto; z-index: 9999; display: none; background: #ffc;">&nbsp;</div>
				</div>
				<div>
					<label for="select">カテゴリ２</label>
					<input type="hidden" class="category_val" name="category[]" value="<?php echo set_value("category", $data["category"][1]);?>" />
					<input type="text" class="category_label" size="60" value="<?php echo set_value("category", $data["category"][1]);?>" />
					<div id="select-category2" class="select-category" style="height: 130px; width: 30em; position: absolute; overflow: auto; z-index: 9999; display: none; background: #ffc;">&nbsp;</div>
				</div>
				<div>
					<label for="select">カテゴリ３</label>
					<input type="hidden" class="category_val" name="category[]" value="<?php echo set_value("category", $data["category"][2]);?>" />
					<input type="text" class="category_label" size="60" value="<?php echo set_value("category", $data["category"][2]);?>" />
					<div id="select-category3" class="select-category" style="height: 130px; width: 30em; position: absolute; overflow: auto; z-index: 9999; display: none; background: #ffc;">&nbsp;</div>
				</div>
				<div>
					<label for="textfield">タグ</label>
					<textarea name="tags" id="spot-tags" rows="1" cols="50"></textarea>
				</div>
				<div id="headerSaveArea">
				ツアーを保存する
				</div>
			</form>
		</div>
		<!-- //ツアー作成 -->
	</div>
</div>
<footer>
	<div id="footerInner">
		aaa<br>
		aaaa<br>
		aaa<br>
	</div>
</footer>
</BODY>
</HTML>