<?php 

	$cond = array(
							0 => array('key' => 'invoice_id', 'val' => $invoice_id)
																					);

	liveTable($this->account_model->modelData('payments'), 
						array('values' => $this->account_model->getPayments($cond),
								'show' => 'invoice_id,creation_date,amount',
								'actions' => array('1' => array('icon' => 'icon-trash',
																'label' => 'delete',
																'target' => '/account/delete_payment/'),
												   '2' => array('icon' => 'icon-eye',
																'label' => 'show payment',
																'target' => '/account/show_payment/')
													)
							)
					);
	
?>

<div class="pull-right">
	<?= anchor('account/payment_new/'.$invoice_id, '<i class="icon-plus icon-white"></i> '.lang('new'), array('class'=>'btn btn-primary btn-small')) ?>
</div>