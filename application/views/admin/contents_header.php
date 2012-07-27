</head>
<body id="makeTour">
<div id="layout">
	<header>
		<div id="headerInner">
			<div style="float: right;">
<?php if($this->admin_info):?>
				<a href="<?php echo base_url("admin/logout");?>">ログアウト</a>
<?php else:?>
				<a href="<?php echo base_url("admin/login");?>">ログイン</a>
<?php endif;?>
			</div>
			<div>
				管理画面
<?php if($this->admin_info):?>
				- <a href="<?php echo base_url("admin/category");?>">カテゴリー</a>
				- <a href="<?php echo base_url("admin/tour");?>">ツアー</a>
				- <a href="<?php echo base_url("admin/spot");?>">スポット</a>
				- <a href="<?php echo base_url("admin/user");?>">ユーザー</a>
				- <a href="<?php echo base_url("admin/tag");?>">タグ</a>
<?php endif;?>
			</div>
		</div>
	</header>
	<div id="container">
