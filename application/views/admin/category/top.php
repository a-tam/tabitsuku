<script type="text/javascript" src="<?php echo base_url("assets/js/jquery/jquery.editinplace.js");?>"></script>
<?php $this->load->view("admin/contents_header"); ?>
<div>
<h2>カテゴリ管理</h2>
<hr size="1" />
/ <a href="<?php echo base_url("admin/category/"); ?>">TOP</a>
<?php
foreach ($this->category["path"] as $key => $name) {
	print ' / <a href="'.base_url("admin/category/".$key).'">'.$name.'</a>'."\n";
}
?>
</div>
<hr size="1" />
カテゴリ一覧
<div>
<form action="<?php echo base_url("admin/category/add")?>" method="post">
<input type="hidden" name="path" value="<?php echo $this->category["info"]["path"];?>" />
<input type="hidden" name="parent_id" value="<?php echo $this->category_id;?>" />
<div>
	<input type="text" name="name" value="" />
	<input type="submit" value="追加" />
</div>
</form>
<style>
<!--
#sortable {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 550px;
}
#sortable li {
    margin: 0 3px 3px 3px;
    padding: 0.3em;
    padding-left: 1em;
    font-size: 15px;
    font-weight: bold;
}
#sortable li span.ui-icon {
    cursor: move;
    position: absolute;
    margin-top: 2px;
    margin-left: 500px;
}
-->
</style>
<script>
	$(function() {
		$( "input[name='name']").focus();
		$( "#sortable" ).sortable({
			handle: 'span',
			update: function (event, ui) {
				var sortOrder = {};
				sortOrder.category = '<?php echo $this->category_id;?>';
				sortOrder.orders = {};
				$("#sortable li").each(function(i, elm) {
					sortOrder.orders[i] = jQuery(elm).attr('data-category');
				});
				// Get form data
				$.ajax({
					url: '<?php echo base_url("admin/category/sort");?>',
					type: "POST",
					data: sortOrder,
					async: false,
					success: function() {
					},
					error: function(XMLHttpRequest, textStatus, errorThrown) {
						console.error(XMLHttpRequest, textStatus, errorThrown);
					}
				});
			}
		});
		$( "#sortable" ).disableSelection();

		$( "#sortable .category-edit").editInPlace({
			url: "<?php echo base_url("admin/category/update")?>",
			element_id: 'id'
		});
	});
</script>
<ul id="sortable">
<?php
	if ($this->list) {
		foreach($this->list->result_array() as $row) {
			print '<li class="ui-state-default" data-category="'.$row["id"].'">'."\n";
			print '<span class="ui-icon ui-icon-arrowthick-2-n-s ui-corner-all ui-state-hover"></span>'."\n";
			print '<a href="'.base_url("admin/category/".$row["id"]).'">◯</a>'."\n";
			print '<span class="category-edit" id="'.$row["id"].'" value="'.$row["id"].'">'.$row["name"].'</span> ( '.$row["child_cnt"].' )';
			print ' [<a href="'.base_url("admin/category/delete/".$row["id"]).'">削除</a>]</li>'."\n";
		}
	}
?>
</ul>
</div>
