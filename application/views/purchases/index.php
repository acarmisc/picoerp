<form class=" form-search well">
  <input type="text" class="input-medium search-query" name="project-q" data-table="purchases" data-field="subject"></form>
<div id="purchases-browser">
	<?php $this->load->view('purchases/browse'); ?>
</div>

<!--
<div class="pull-right">
	<?= anchor('purchases/new_purchase', '<i class="icon-plus icon-white"></i> '.lang('new_quote'), array('class'=>'btn btn-primary btn-small')) ?>
</div>
-->