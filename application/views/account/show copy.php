<?php
	$invoice = $this->account_model->getInvoices(array(0 => array('key'=>'invoices.id', 'val'=>$this->uri->segment(3))));
?>

 <div class="tabbable"> 
	  <ul class="nav nav-tabs">
	    <li class="active"><a href="#tab1" data-toggle="tab"><?= lang('invoice') ?></a></li>
	    <li><a href="#tab2" data-toggle="tab"><?= lang('attachments') ?></a></li>
	    <li><a href="#tab3" data-toggle="tab"><?= lang('payments') ?></a></li>	    
	  </ul>
	  <div class="tab-content">
	    <div class="tab-pane active" id="tab1">

<?= form_open('account/invoice_save/', array('onsubmit'=>'', 'class'=>'well form-horizontal', 'id'=>'invoice-details')) ?>
			
			<?php liveForm($this->account_model->modelData('invoice'), 
							array('layout' => 'horiz', 
								   'values' => $this->account_model->getInvoices(array(0 => array('key'=>'invoices.id', 'val'=>$this->uri->segment(3))))
								   )
						); ?>
			
<?= form_close() ?>


<h4>Order elements</h4>
<!-- invoice rows -->
	<?php 
		
		liveTable($this->account_model->modelData('invoice_line'), 
							array('values' => $this->account_model->getLines(),
									'show' => 'product_id,partner_id,price_external,creation_date',
									'actions' => array('1' => array('icon' => 'icon-trash',
																	'label' => 'delete',
																	'target' => '/sales/quotationreq_delete/')
														)
								)
						);
		
	?>


<p align="center">
<!--<button class="btn" id="quote-save-submit" onclick="history.back()"><i class="icon-chevron-left"></i> <?= lang('back') ?></button>-->

<button class="btn" id="" onclick=""><i class="icon-chevron-left"></i> <?= lang('back') ?></button>
<button class="btn" id="" onclick=""><i class="icon-print"></i> <?= lang('print') ?></button>
<button class="btn btn-warning" id="recalculate-invoice"><i class="icon-repeat icon-white"></i> <?= lang('recalculate') ?></button>

<?= $this->load->view('account/invoice_footer', array('id'=>$this->uri->segment(3), 'currency'=>'&euro;')) ?>

<?= designWorkflow(5, $invoice[0]->wf_step, array('table' => 'invoices', 'id' => $this->uri->segment(3))) ?>
 
	    </div>
	    <div class="tab-pane" id="tab2">

		    <?php $this->load->view('account/attachments'); ?>

	    </div>
	    
	    <div class="tab-pane" id="tab3">

		    <?php $this->load->view('account/payments'); ?>

	    </div>
	    	    
	  </div>
	</div>

