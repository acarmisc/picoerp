<div>




<form class=" form-search well" onsubmit="return false">
  <input type="text" class="input-medium search-query" 
  	name="sales-q" data-table="sales" 
  	data-field="title" 
  	placeholder="title" 
  	/>
  	<input type="text" class="input-medium search-query" 
  	name="sales-q" data-table="sales" 
  	data-field="name" 
  	placeholder="customer" 
  	/>
    <div class="pull-right btn-group" data-toggle="buttons-checkbox" id="transactions-
filter">
    <button class="btn active" onclick="liveToggle('row-state-1')">has prj</button>
    <button class="btn active" onclick="liveToggle('row-state-2')">no prj</button> 
</div>
</form>



</div>

<div id="sales-browser">
	<?php $this->load->view('sales/browser'); ?>
</div>

<div class="pull-right">
	<?= anchor('sales/new_quote', '<i class="icon-plus icon-white"></i> '.lang('new_quote'), array('class'=>'btn btn-primary btn-small')) ?>
</div>