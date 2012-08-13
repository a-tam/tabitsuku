</head>
<body id="makeTour">
<div id="layout">
	<header>
		<div id="headerInner" class="clearfix">
			<div id="headerNavi">
				<h1><img src="/assets/img/interface/logo_s.png" alt="旅ツク" width="108" height="29"></h1>
				<ul>
					<li><a href="<?php echo base_url("/");?>">TOP</a></li>
					<li><a href="<?php echo base_url("tour/search");?>">ツアー検索</a></li>
					<li><a href="<?php echo base_url("spot/search");?>">スポット検索</a></li>
				
				<?php if($this->user_info):?>
					<li><a href="<?php echo base_url("user/tour/form");?>">ツアー作成</a></li>
					<li><a href="<?php echo base_url("user/spot/form");?>">スポット作成</a></li>
				<?php endif;?>
				</ul>
			</div>
			<div id="personalNavi">
				<ul>
				<?php if(!$this->user_info):?>
					 	<li><a href="<?php echo base_url("user/top");?>">会員登録・ログイン</a></li>
						<li>ようこそ ゲスト さん</li>
					
					<?php else:?>
						<li><a href="<?php echo base_url("user/top");?>">マイページ</a></li>
						<li><a href="<?php echo base_url("user/top/logout");?>">ログアウト</a></li>
						<li>ようこそ <a href="<?php echo base_url("user/profile");?>"><?php echo $this->user_info["name"];?></a> さん</li>
					<?php endif;?>
				</ul>
			</div>
			
		</div>
	</header>
	<div id="container">
