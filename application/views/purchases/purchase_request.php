<form class=" form-search well">
  <input type="text" class="input-medium search-query">
  <button type="submit" class="btn">Search</button>
</form>
<div id="crm-browser">
	<?php $this->load->view('purchases/browse_requests'); ?>
</div>

<!--
<div class="pull-right">
	<?= anchor('purchases/new_purchase', '<i class="icon-plus icon-white"></i> '.lang('new_quote'), array('class'=>'btn btn-primary btn-small')) ?>
</div>
-->