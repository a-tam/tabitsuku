<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=true&libraries=places"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery/textext/jquery.textext.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery/jstree/jquery.jstree.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery/util/jquery.cookie.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/jquery/util/jquery.hotkeys.js"); ?>"></script>
<script type="text/javascript">
$(function() {
	var lat = '<?php echo set_value("x", 35.6894875);?>';
	var lng = '<?php echo set_value("y", 139.69170639999993);?>';
	var latlng = new google.maps.LatLng(lat, lng);
	var myOptions = {
		zoom: 10,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("map_canvas"),
	myOptions);

	var input = document.getElementById('search-address');
	var autocomplete = new google.maps.places.Autocomplete(input);
	var marker = new google.maps.Marker({
		map: map,
		draggable: true
	});

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
		var request={
				location: place.geometry.location,
				radius: '500',
				types: [_place],
				name: _name
			};
//		infowindow = new google.maps.InfoWindow();
//		service = new google.maps.places.PlacesService(map);
//		service.search(request, callback);
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
			$("#flip-address").val(results[0].formatted_address);
		} else {
		// エラーの場合
			$("#flip-address").val("");
		}
		});
		$("#flip-x").val(location.lat());
		$("#flip-y").val(location.lng());
	}

	google.maps.event.addListener(map, 'click', function(event){
		marker.setPosition(event.latLng);
		setPosition(event.latLng);
	});

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
		$("#flip-category").val(id.replace("node_", ""));
	});
	
	// タグ
	$('#flip-tags').textext({
		plugins : 'tags prompt focus autocomplete ajax arrow',
		tagsItems : [<?php echo set_value("tags");?>],
		prompt : 'Add one...',
		ajax : {
			url : '<?php echo base_url("user/tag/search/");?>',
			dataType : 'json',
			cacheResults : true
		}
	});
});
</script>
<p>
<label>検索</label>
<input type="text" id="search-address" value="" />
<!-- select id="search-place">
<option value="accounting">会計事務所</option>
<option value="airport">空港</option>
<option value="amusement_park">遊園地</option>
<option value="aquarium">水族館</option>
<option value="art_gallery">アート ギャラリー</option>
<option value="atm">ATM</option>
<option value="bakery">ベーカリー、パン屋</option>
<option value="bank">銀行</option>
<option value="bar">居酒屋</option>
<option value="beauty_salon">ビューティー サロン</option>
<option value="bicycle_store">自転車店</option>
<option value="book_store">書店</option>
<option value="bowling_alley">ボウリング場</option>
<option value="bus_station">バスターミナル</option>
<option value="cafe">カフェ</option>
<option value="campground">キャンプ場</option>
<option value="car_dealer">カー ディーラー</option>
<option value="car_rental">レンタカー</option>
<option value="car_repair">車の修理</option>
<option value="car_wash">洗車場</option>
<option value="casino">カジノ</option>
<option value="cemetery">墓地</option>
<option value="church">教会</option>
<option value="city_hall">市役所</option>
<option value="clothing_store">衣料品店</option>
<option value="convenience_store">コンビニエンス ストア</option>
<option value="courthouse">裁判所</option>
<option value="dentist">歯科医</option>
<option value="department_store">百貨店</option>
<option value="doctor">医者</option>
<option value="electrician">電気工</option>
<option value="electronics_store">電器店</option>
<option value="embassy">大使館</option>
<option value="establishment">施設</option>
<option value="finance">金融業</option>
<option value="fire_station">消防署</option>
<option value="florist">花屋</option>
<option value="food">食料品店</option>
<option value="funeral_home">葬儀場</option>
<option value="furniture_store">家具店</option>
<option value="gas_station">ガソリンスタンド</option>
<option value="general_contractor">建設会社</option>
<option value="geocode">ジオコード</option>
<option value="grocery_or_supermarket">スーパー</option>
<option value="gym">スポーツクラブ</option>
<option value="hair_care">ヘアケア</option>
<option value="hardware_store">金物店</option>
<option value="health">健康</option>
<option value="hindu_temple">ヒンドゥー寺院</option>
<option value="home_goods_store">インテリア ショップ</option>
<option value="hospital">病院</option>
<option value="insurance_agency">保険代理店</option>
<option value="jewelry_store">宝飾店</option>
<option value="laundry">クリーニング店</option>
<option value="lawyer">弁護士</option>
<option value="library">図書館</option>
<option value="liquor_store">酒店</option>
<option value="local_government_office">役場</option>
<option value="locksmith">錠屋</option>
<option value="lodging">宿泊施設</option>
<option value="meal_delivery">出前</option>
<option value="meal_takeaway">テイクアウト</option>
<option value="mosque">モスク</option>
<option value="movie_rental">DVD レンタル</option>
<option value="movie_theater">映画館</option>
<option value="moving_company">引越会社</option>
<option value="museum">美術館/博物館</option>
<option value="night_club">ナイト クラブ</option>
<option value="painter">塗装業</option>
<option value="park">公園</option>
<option value="parking">駐車場</option>
<option value="pet_store">ペット ショップ</option>
<option value="pharmacy">薬局</option>
<option value="physiotherapist">理学療法士</option>
<option value="place_of_worship">礼拝所</option>
<option value="plumber">配管工</option>
<option value="police">警察</option>
<option value="post_office">郵便局</option>
<option value="real_estate_agency">不動産業</option>
<option value="restaurant">レストラン</option>
<option value="roofing_contractor">防水工事業</option>
<option value="rv_park">オート キャンプ場</option>
<option value="school">学校</option>
<option value="shoe_store">靴屋</option>
<option value="shopping_mall">ショッピング モール</option>
<option value="spa">温泉、スパ</option>
<option value="stadium">スタジアム</option>
<option value="storage">倉庫</option>
<option value="store">小売店</option>
<option value="subway_station">地下鉄駅</option>
<option value="synagogue">シナゴーグ</option>
<option value="taxi_stand">タクシー乗り場</option>
<option value="train_station">駅</option>
<option value="travel_agency">旅行代理店</option>
<option value="university">大学</option>
<option value="veterinary_care">獣医</option>
<option value="zoo">動物園</option>
</select>
<input type="text" id="search-name" value="" / -->
<input type="button" value="検索" />
</p>
<div id="map_canvas" style="width:800px; height:320px"></div>
<?php echo validation_errors(); ?>
<form action="<?php echo base_url("user/flip/add");?>" enctype="multipart/form-data" method="post">
<fieldset>
<legend>フリップ追加</legend>
<p>
<label>緯度</label>
<input type="text" name="x" id="flip-x" value="<?php echo set_value("x", 35.6894875);?>" readonly="readonly" />
<label>経度</label>
<input type="text" name="y" id="flip-y" value="<?php echo set_value("y", 139.69170639999993);?>" readonly="readonly" />
<p>
<p>
<label>住所</label>
<input type="text" name="address" id="flip-address" size="120" value="<?php echo set_value("address");?>" readonly="readonly" />
</p>
<p>
<label>名称</label>
<input type="text" name="name" value="<?php echo set_value("name", "東京タワー");?>" />
</p>
<p>
<label>基本滞在時間</label>
<input type="text" name="stay_time" value="<?php echo set_value("stay_time", "60");?>" />
</p>
<p>
<label>説明</label>
<textarea name="description" rows="4" cols="60"><?php echo set_value("description", "この鉄塔を建設する際、電波科学の権威を結集してそれぞれ綿密、慎重な検討を行なった結果、東京地区のＶＨＦテレビ7局以上と将来開局が予定されるＵＨＦテレビ局が、東京を中心とした関東一円（北は水戸、東は銚子、南は沼津、西は甲府）をサービスエリアとして電波を送る場合に、鉄塔の必要な高さは333ｍであるということがわかりました。");?></textarea>
</p>
<p>
<label>サムネイル</label>
<input type="file" name="image" value="" />
</p>
<p>
<label>カテゴリ</label>
<input type="text" name="category" id="flip-category" value="<?php echo set_value("category");?>" readonly="readonly" />
<div id="select-category" style="height: 80px; width: 30em; overflow: auto;"></div>
</p>
<p>
<label>タグ</label>
<textarea name="tags" id="flip-tags" rows="1" cols="50"></textarea><?php echo set_value("tags");?>
</p>
<p>
<input type="submit" value="登録" />
</p>
</fieldset>
</form>