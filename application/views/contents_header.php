</head>
<body id="makeTour">
<div id="layout">
	<header>
		<div id="headerInner">
			<div style="float: right;">
<?php if($this->user_info):?>
			ようこそ <a href="<?php echo base_url("user/profile");?>"><?php echo $this->user_info["name"];?></a> さん
			- <a href="<?php echo base_url("user/top");?>">マイページ</a>
			- <a href="<?php echo base_url("user/top/logout");?>">ログアウト</a>
<?php else:?>
			ようこそ ゲスト さん
			- <a href="<?php echo base_url("user/top");?>">会員登録・ログイン</a>
<?php endif;?>
			</div>
			<div>
				たびつくロゴ
				- <a href="<?php echo base_url("/");?>">TOP</a>
				- <a href="<?php echo base_url("tour/search");?>">ツアー検索</a>
				- <a href="<?php echo base_url("spot/search");?>">スポット検索</a>
<?php if($this->user_info):?>
				- <a href="<?php echo base_url("user/tour/form");?>">ツアー作成</a>
				- <a href="<?php echo base_url("user/spot/form");?>">スポット作成</a>
<?php endif;?>
			</div>
		</div>
	</header>
	<div id="container">
