<?php $this->load->view("header"); ?>
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets");?>/css/modules/login.css" />
</head>
<body id="login">
	<div class="box" id="login_box">
		<p class="title"><img src="<?php echo base_url("assets");?>/img/login/login.gif" alt="ログイン" /></p>
		
		<p class="facebook"><a href="<?php echo $fb_login; ?>" target="_top" class="mouse_over"><img src="<?php echo base_url("assets");?>/img/common/facebook.gif" alt="Facebookアカウントでログイン" /></a></p>
		<form>
		<dl>
			<dt><img src="<?php echo base_url("assets");?>/img/login/userid.gif" alt="ユーザーID" /></dt>
			<dd><input type="text" name="userid" value="" class="text" /></dd>
			<dt><img src="<?php echo base_url("assets");?>/img/login/password.gif" alt="パスワード" /></dt>
			<dd><input type="text" name="password" value="" class="text" /><br /><a href="" class="textlink">パスワードを忘れた方はこちら</a></dd>
		</dl>
		<p class="submit mouse_over"><input type="image" src="<?php echo base_url("assets");?>/img/login/submit.gif" alt="送信" /></p>
		</form>
		
	</div>
	<!-- //login_box -->

	<div class="box" id="regist_box">
		<p class="title"><img src="<?php echo base_url("assets");?>/img/login/regist.gif" alt="新規会員登録" /></p>
		
		<form>
		<dl>
			<dt><img src="<?php echo base_url("assets");?>/img/login/useridmail.gif" alt="ユーザーID（Email）" /></dt>
			<dd><input type="text" name="userid" value="" class="text" /></dd>
			<dt><img src="<?php echo base_url("assets");?>/img/login/password.gif" alt="パスワード" /></dt>
			<dd><input type="text" name="password" value="" class="text" /></dd>
			<dt><img src="<?php echo base_url("assets");?>/img/login/name.gif" alt="お名前" /></dt>
			<dd><input type="text" name="name" value="" class="text" /></dd>
		</dl>
		<p class="sub"><input type="checkbox" name="namehidden" id="namehidden" class="namehidden" /><label class="namehidden" for="namehidden">名前を非公開</label><a href="" class="textlink">利用規約はこちら</a></p>
		<p class="submit mouse_over"><input type="image" src="<?php echo base_url("assets");?>/img/login/submit.gif" alt="送信" /></p>
		</form>
		
	</div>
	<!-- //login_box -->


</body>
</html>