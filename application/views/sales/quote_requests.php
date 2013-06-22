<div class=" form-search well"
<form class="">
  <input type="text" class="input-medium search-query">
  <button type="submit" class="btn">Search</button>
  
</form>
  <div class="pull-right btn-group" data-toggle="buttons-checkbox" id="transactions-
filter">
    <button class="btn active" onclick="liveToggle('row-state-new')">new</button>
    <button class="btn active" onclick="liveToggle('row-state-binded')">binded</button>
</div>
</div>

<?= showFlashes($flash_messages) ?>


<div id="quoterequests-browser">
	<?php 
		
		liveTable($this->sales_model->modelData('quotationreq'), 
							array('values' => $this->sales_model->getQuoteRequests(),
									'show' => 'userfile_type,subject,partner_id, notes,wf_step,creation_date',
									'actions' => array('1' => array('icon' => 'icon-trash',
																	'label' => 'delete',
																	'target' => '/sales/quotationreq_delete/'),
													   '2' => array('icon' => 'icon-download',
																	'label' => 'download file',
																	'target' => '/sales/quotationreq_show_file/'),
														)
								)
						);
		
	?>
</div>

<div class="pull-right">
	<?= anchor('sales/quotationreq_new', '<i class="icon-plus icon-white"></i> '.lang('new_quotationreq'), array('class'=>'btn btn-primary btn-small')) ?>
</div>

