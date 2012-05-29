<!DOCTYPE html><html lang="ja" id="todo">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title><?php echo $header["title"];?> | <?php echo $header["sub_title"];?></title>
<?php foreach ($header["css_files"] as $css_file):?>
<link type="text/css" rel="stylesheet" href="<?php echo base_url().$css_file; ?>" />
<?php endforeach;?>
<?php foreach ($header["js_files"] as $js_file):?>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url().$js_file; ?>"></script>
<?php endforeach;?>
</head>
<body>
<!-- Contents Header -->
<a href="<?php echo base_url();?>"><img src="<?php echo base_url("assets/images/common/logo.jpg");?>" /></a>
<!-- GlobalNavi -->
<!-- GlobalNavi End -->
<?php if($this->user_info):?>
<a href="<?php echo base_url("user/top/logout");?>">ログアウト</a>
<?php else:?>
<a href="<?php echo base_url("user/top");?>">ログイン</a>
<?php endif;?>
<hr size="1" />