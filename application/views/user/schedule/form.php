	<link rel="stylesheet" href="<?php echo base_url("assets/css/common/import.css"); ?>">
	<!-- java script -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
	<script src="<?php echo base_url("assets/js/jscrollpane/jquery.jscrollpane.min.js");?>"></script>
	<script type="text/javascript">
	  $(function() {
      $('#sortable1').sortable({
        connectWith: '.flipList',
        placeholder: 'ui-state-highlight',
		cursor: 'move',
        opacity: 0.5
      });
      $('#sortable2').sortable({
        connectWith: '.flipList',
        placeholder: 'ui-state-highlight',
		cursor: 'move',
        opacity: 0.5
      });
	    $('ui.flipList').disableSelection();
	  });
	</script>

	<script type="text/javascript">
	$(function()
{
	$('.scroll-pane').jScrollPane();
});
</script>
	</head>
	<body">
	
	<div id="layout">
		<div id="schejuleBlock">
			<p class="listTitle">スケジュールを組立てる</p>
			<ul id="sortable1" class="flipList">
			</ul>
		</div>
		<div id="flipBlock">
			<p class="listTitle">行きたい場所を探す</p>
			<ul id="sortable2" class="flipList">
				<li class="flip">
					<div class="min60"> <img src="<?php echo base_url("assets/images/flips");?>/douwamura.JPG" width="110" height="81" alt="写真" class="flipPhoto">
						<p class="flipTitle">童話村</p>
						<p class="flipDescription">村内には、賢治の世界を５つのテーマゾーンで表現した「賢治の学校」や・・・</p>
					</div>
					<div class="flipBtnArea">滞在時間：60分　<a href="#">詳細を見る</a></div>
				</li>
				<li class="flip">
					<div class="min60"> <img src="<?php echo base_url("assets/images/flips");?>/karakuri_tokei.JPG" width="110" height="81" alt="写真" class="flipPhoto">
						<p class="flipTitle">銀河ポッポからくり時計</p>
						<p class="flipDescription"> 「銀河鉄道の夜」をモチーフにしたからくり時計。長針が ・・・</p>
					</div>
					<div class="flipBtnArea">滞在時間：60分　<a href="#">詳細を見る</a></div>
				</li>
				<li class="flip">
					<div class="min120"> <img src="<?php echo base_url("assets/images/flips");?>/kinkon.JPG" width="110" height="81" alt="写真" class="flipPhoto">
						<p class="flipTitle">金婚亭</p>
						<p class="flipDescription">「金婚漬」で知られる漬物屋が営む物産館とレストラン。おすすめは、名物の「わんこそば」や「ひっつみ田舎御前」。花巻のわんこそばは、殿様にふるまったことが発祥のため、横からではなく前から勧めるのが特徴だといいます。隠れメニューは１階売店の「漬物ソフトクリーム」！美味です。</p>
					</div>
					<div class="flipBtnArea">滞在時間：120分　<a href="#">詳細を見る</a></div>
				</li>
				<li class="flip">
					<div class="min60"> <img src="<?php echo base_url("assets/images/flips");?>/ueno.JPG" width="110" height="81" alt="写真" class="flipPhoto">
						<p class="flipTitle">上野豆富店</p>
						<p class="flipDescription">盛岡は「豆腐消費量日本一！」とご存知でしたか？もちろん豆腐屋さんも多く、その一つ「上野豆富店」は、創業１５０年の老舗。自慢の「寄せ豆腐」は昔と変わらぬ製法で、ご主人が丹誠こめて作っています。市内の寺には豆腐のお地蔵さんまであるんですよ。</p>
					</div>
					<div class="flipBtnArea">滞在時間：60分　<a href="#">詳細を見る</a></div>
				</li>
				<li class="flip">
					<div class="min90"> <img src="<?php echo base_url("assets/images/flips");?>/yamanekoken.JPG" width="110" height="81" alt="写真" class="flipPhoto">
						<p class="flipTitle">山猫軒</p>
						<p class="flipDescription">「注文の多い料理店」をモデルにしたレストランです。店内に掛けられた猫の額縁には、思わずクスッと笑いたくなうような、賢治の可愛らしい言葉が並びます。</p>
					</div>
					<div class="flipBtnArea">滞在時間：90分　<a href="#">詳細を見る</a></div>
				</li>
				<li class="flip">
					<div class="min120"> <img src="<?php echo base_url("assets/images/flips");?>/yataimura.JPG" width="110" height="81" alt="写真" class="flipPhoto">
						<p class="flipTitle">屋台村</p>
						<p class="flipDescription">ふれあいがあって、懐かしくて、ほっと心が和む屋台村で岩手ならではのうまい酒と料理をご堪能ください。</p>
					</div>
					<div class="flipBtnArea">滞在時間：120分　<a href="#">詳細を見る</a></div>
				</li>
			</ul>
		</div>
		<p class="clear">&nbsp;</p>
	</div>
