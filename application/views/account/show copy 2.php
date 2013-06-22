<?php
	$invoice = $this->account_model->getInvoices(array(0 => array('key'=>'invoices.id', 'val'=>$this->uri->segment(3))));
?>

 <div class="tabbable"> 
	  <ul class="nav nav-tabs">
	    <li class="active"><a href="#tab1" data-toggle="tab"><?= lang('invoice') ?></a></li>
	    <li><a href="#tab2" data-toggle="tab"><?= lang('attachments') ?></a></li>
	    <li><a href="#tab3" data-toggle="tab"><?= lang('payments') ?></a></li>	    
	    <li><a href="#tab4" data-toggle="tab"><?= lang('terms') ?></a></li>
	  </ul>
	  <div class="tab-content">
	    <div class="tab-pane active" id="tab1">

	    
	    <?php 
	    	$inv = $this->account_model->getInvoices(array(0 => array('key'=>'invoices.id', 'val'=>$this->uri->segment(3))));
	    	if($inv[0]->direction != 1)	{ ?>
	    <div class="pull-right">
	    <div class="btn-group">
		    <button class="btn btn-inverse"><i class="icon-share-alt icon-white"></i> Share</button>
		    <button class="btn dropdown-toggle btn-inverse" data-toggle="dropdown">
		    	<span class="caret"></span>
		    </button>
		    <ul class="dropdown-menu">
		    	<li><?= anchor('account/print_invoice/'.$this->uri->segment(3), 
	    		'<i class="icon-print"></i> '.lang('print'),
	    		array('target'=>'_blank', 'class'=>'')) ?></li>
	    		<li><a title="send via mail" data-toggle="modal" href="#myModal" id="send_invoice_mail" name="<?= $invoice[0]->id ?>"><i class="icon-envelope"></i> send email</a></li>

	    		<li><?= anchor('account/print_invoice_view/'.$this->uri->segment(3), 
	    		'<i class="icon-picture"></i> '.lang('print').' preview',
	    		array('target'=>'_blank', 'class'=>'')) ?></li>
	    	</ul>
	    </div>
	    </div>
	    	<?php } ?>

<?= form_open('account/invoice_update/'.$this->uri->segment(3), array('onsubmit'=>'', 'class'=>'well form-horizontal', 'id'=>'invoice-details')) ?>
			
			<?php liveForm($this->account_model->modelData('invoice'), 
							array('layout' => 'horiz', 
								   'values' => $this->account_model->getInvoices(array(0 => array('key'=>'invoices.id', 'val'=>$this->uri->segment(3))))
								   )
						); ?>
			
			<input type="submit" value="<?= lang('save') ?>" class="btn btn-primary" />
			
<?= form_close() ?>


<?= designWorkflow(5, $invoice[0]->wf_step, array('table' => 'invoices', 'id' => $this->uri->segment(3))) ?>
 
	    </div>
	    <div class="tab-pane" id="tab2">

		    <?php $this->load->view('account/attachments'); ?>

	    </div>
	    
	    <div class="tab-pane" id="tab3">

		    <?php $this->load->view('account/payments', array('invoice_id' => $this->uri->segment(3))); ?>

	    </div>

	    <div class="tab-pane" id="tab4">

		    <?php $this->load->view('account/terms', array('invoice_id' => $this->uri->segment(3))); ?>

	    </div>	    
	    
	  </div>
	</div>

