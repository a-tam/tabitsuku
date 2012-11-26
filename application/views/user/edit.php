<?php $this->load->view("header"); ?>
<!-- css -->
<link rel="stylesheet" type="text/css" media="screen,print" href="<?php echo base_url("assets");?>/css/modules/useredit.css" />

<!-- javascript -->
<script type="text/javascript" src="<?php echo base_url("assets");?>/js/useredit.js"></script>

</head>
<body id="useredit">
<div class="box">
	<form>
	<h1><img src="<?php echo base_url("assets");?>/img/user/top/useredit.gif" alt="登録内容変更" /></h1>
	<dl id="username_display">
		<dt><img src="<?php echo base_url("assets");?>/img/user/top/name_display.gif" alt="登録名を表示しますか？" /></dt>
		<dd>
			<ul>
				<li><input type="radio" name="namedisplay" value="display" checked id="radio_name_display" /><label for="radio_name_display"><img src="<?php echo base_url("assets");?>/img/user/top/display.gif" alt="表示する" /></label></li>
				<li><input type="radio" name="namedisplay" value="nondisplay" id="radio_name_nondisplay" /><label for="radio_name_nondisplay"><img src="<?php echo base_url("assets");?>/img/user/top/nondisplay.gif" alt="非表示にする" /></label></li>
			</ul>
			<p class="frame">&nbsp;</p>
		</dd>
	</dl>
	<dl id="username">
		<dt><img src="<?php echo base_url("assets");?>/img/user/top/username.gif" alt="登録名" /></dt>
		<dd><input type="text" name="username" value="山田太郎" class="text" /></dd>
	</dl>
	<p class="submit mouse_over"><input type="image" src="<?php echo base_url("assets");?>/img/user/top/editbtn.gif" alt="登録内容を変更" /></p>
	</form>
</div>
</body>
</html>