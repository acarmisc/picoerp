<div class="tabbable"> <!-- Only required for left/right tabs -->
	  <ul class="nav nav-tabs">
	    <li class="active"><a href="#details" data-toggle="tab"><?= lang('details') ?></a></li>
	    <li><a href="#attachments" data-toggle="tab"><?= lang('attachments') ?></a></li>
	  </ul>
	  <div class="tab-content" >
	    <div class="tab-pane active" id="details">
	    
	    	<?= $this->load->view('purchases/edit_request', array('data'=>$data)) ?>
	    
	    </div>
	    <div class="tab-pane" id="attachments">
		  <?= $this->load->view('attachments/quicklist', array(
														'related_to' => 'purchases_request',
														'related_to_id' => $this->uri->segment(3))); ?>
	    </div>    
	    
	    
	  </div>
	</div>