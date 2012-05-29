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
旅つく管理画面
<!-- GlobalNavi -->
<!-- GlobalNavi End -->
<?php if($this->admin_info):?>
<a href="<?php echo base_url("admin/logout");?>">ログアウト</a>
<div>
<ul>
<li><a href="<?php echo base_url("admin/category");?>">カテゴリー</a></li>
<li><a href="<?php echo base_url("admin/schedule");?>">スケジュール</a></li>
<li><a href="<?php echo base_url("admin/point");?>">フリップ</a></li>
<li><a href="<?php echo base_url("admin/tag");?>">タグ</a></li>
</ul>
</div>
<?php endif;?>

<hr size="1" />