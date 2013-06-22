
<form class=" form-search well">
  
  

</form>
  
<div class="pull-right">
	<?= anchor('account/new_invoice', '<i class="icon-plus icon-white"></i> '.lang('new'), array('class'=>'btn btn-primary btn-small')) ?>
</div>


<div id="crm-browser">
	<?php $this->load->view('account/browse'); ?>
</div>

<div class="pull-right">
	<?= anchor('account/new_invoice', '<i class="icon-plus icon-white"></i> '.lang('new'), array('class'=>'btn btn-primary btn-small')) ?>
</div>