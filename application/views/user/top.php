<script type="text/javascript" src="<?php echo base_url("assets"); ?>/js/apps/user/top.js"></script>
<?php $this->load->view("contents_header"); ?>
<h3>トップページ</h3>
<div>あなたが登録したスケジュール一覧</div>
[<a href="<?php echo base_url("user/tour/form");?>">追加</a>]<br />
<ul id="tour_list"></ul>

<div>あなたが登録した位置情報一覧</div>
[<a href="<?php echo base_url("user/spot/form");?>">追加</a>]
<ul id="spot_list"></ul>
