<?php $this->load->view("header"); ?>
<div class="contents">
<font color="gray"><?php echo $main_page;?></font><br />
<?php $this->load->view($main_page); ?>
</div>
<?php $this->load->view("footer"); ?>
