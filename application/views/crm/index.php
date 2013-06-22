<form class=" form-search">
  <input type="text" class="input-medium search-query">
  <button type="submit" class="btn">Search</button>
</form>

<div class="pull-right">
	<?= anchor('crm/new_partner', '<i class="icon-plus icon-white"></i> '.lang('add_partner'), array('class'=>'btn btn-primary btn-small')) ?>
</div>


<div id="crm-browser">
	<?php $this->load->view('crm/browser'); ?>
</div>
<p>
	<span class="badge badge-info"><?= lang('customer')?></span>
	<span class="badge badge-warning"><?= lang('supplier')?></span>
</p>

<div class="pull-right">
	<?= anchor('crm/new_partner', '<i class="icon-plus icon-white"></i> '.lang('add_partner'), array('class'=>'btn btn-primary btn-small')) ?>
</div>