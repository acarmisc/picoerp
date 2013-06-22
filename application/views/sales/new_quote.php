<?php 
	setlocale(LC_MONETARY, 'it_IT');
?>

<div class="pull-right">
	    <div class="btn-group">
		    <button class="btn btn-inverse"><i class="icon-share-alt icon-white"></i> Share</button>
		    <button class="btn dropdown-toggle btn-inverse" data-toggle="dropdown">
		    	<span class="caret"></span>
		    </button>
		    <ul class="dropdown-menu">
		    	<li><?= anchor('sales/print_quotation/'.$this->uri->segment(3), 
	    		'<i class="icon-print"></i> '.lang('print'),
	    		array('target'=>'_blank', 'class'=>'')) ?></li>
	    		<li><?= anchor('sales/print_preview_quotation/'.$this->uri->segment(3), 
	    		'<i class="icon-print"></i> '.lang('print').' preview',
	    		array('target'=>'_blank', 'class'=>'')) ?></li>
	    	</ul>
	    </div>
	    </div>
	    
	    
 <div class="tabbable"> 
	  <ul class="nav nav-tabs">
	    <li class="active"><a href="#tab1" data-toggle="tab"><?= lang('new_quote') ?></a></li>
	    <li><a href="#tab2" data-toggle="tab"><?= lang('attachments') ?></a></li>
	  </ul>
	  <div class="tab-content">
	    <div class="tab-pane active" id="tab1">
<?php
	
	$query = $this->db->get_where('quotations', array('id'=>$id));

    if(sizeof($query->result())>0):
	    foreach($query->result() as $r):
?>

<?= form_open('sales/save_quote/', array('onsubmit'=>'return false', 'class'=>'well form-horizontal', 'id'=>'quote-details')) ?>

	<input type="hidden" name="partner_id" value="<?= $this->session->userdata('current_partner') ?>" />
	<input type="hidden" name="id" value="<?= $r->id ?>" />
	<input type="hidden" name="update_date" value="<?= time() ?>" />

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('type') ?></label>
      <div class="controls">
        <select name="type">
        		<option value="0" >scegli...</option>
        		<option value="spare"<?php if($r->type == 'spare'){ echo 'selected="selected "'; }?> >spare</option>
				<option value="project" <?php if($r->type == 'project'){ echo 'selected="selected "'; }?> >project</option>
				<option value="extra" <?php if($r->type == 'extra'){ echo 'selected="selected "'; }?> >extra</option>				        		
        </select>
      </div>
    </div>      
	
	<div class="span4 pull-right white-box">
		<?php
			$this->db->select('quotationreq.subject, quotationreq.id');
			$this->db->join('quotationreq', 'quotationreq.id = req_quotation.request_id');
			$q = $this->db->get_where('req_quotation', array('quotation_id' => $this->uri->segment(3)));
			foreach($q->result() as $r1){
				echo '<span class="label label-info"><a style="color:white" data-toggle="modal" href="#myModal" 
				class="show_quotereq" name="'.$r1->id.'" >
				'.$r1->subject.' ('.$r1->id.')</a></span> ';
			}
		?>
		<?php
	$r->currency = "&euro;";
?>
	  
	</div>
			
  <div class="control-group">
      <label class="control-label" for="input01"><?= lang('title') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge fillhead" id="contact-name" name="title" placeholder="<?= lang('title') ?>" value="<?= $r->title ?>"> 	
        <?php if (isset($r->id)): ?>
        	<button class="btn btn-primary  btn-mini" id="quote-save-submit"><?= lang('update') ?></button> <span id="quote-save-result"></span>
        <?php else: ?>
        	<button class="btn btn-primary  btn-mini" id="quote-save-submit"><?= lang('save') ?></button> <span id="quote-save-result"></span>
        <?php endif; ?>
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label" for="input01">Attn</label>
      <div class="controls">
        <input type="text" name="attn" value="<?= $r->attn?>" />
      </div>
    </div>    
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('customer') ?></label>
      <div class="controls">
        <select name="partner_id">
        		<option value="0">scegli...</option>
        	<?php 
        		$this->db->order_by('name ASC');
        		$query = $this->db->get_where('partners',  array('status' => 1));
        		foreach($query->result() as $r1):
        		if ($r->partner_id == $r1->id): $s = '  selected="selected" '; else: $s = ''; endif; ?>
        		<option <?= $s ?> value="<?= $r1->id ?>"><?= $r1->name ?></option>
        	<?php endforeach; ?>
        </select>
      </div>
    </div>    
    
	
		
		
			<div class="control-group">
     	 <label class="control-label" for="input01">Your reference</label>
      	<div class="controls">
        	<input type="text" name="reference" class="" value="<?= $r->reference?>" />
      	</div>
    </div> 
    
        <div class="control-group">
      <label class="control-label" for="input01"><?= lang('description') ?></label>
      <div class="controls">
        <textarea name="description" style="width:400px"><?= $r->description ?></textarea>
      </div>
    </div> 
    
    		
	<div class="control-group" style="display:inline-block">
     	 <label class="control-label" for="input01">Delivery Terms</label>
      	<div class="controls">
        	<input type="text" name="delivery_terms" class="" value="<?= $r->delivery_terms?>" />
      	</div>
    </div> 
    
        
	<div class="control-group" style="display:inline-block">
     	 <label class="control-label" for="input01">Delivery Time</label>
      	<div class="controls">
        	<input type="text" name="delivery_time" class="" value="<?= $r->delivery_time?>" />
      	</div>
    </div> 
    
   
    <div class="control-group">
      <label class="control-label" for="input01">Destination</label>
      <div class="controls">
        <textarea name="destination" style="width:400px"><?= $r->destination ?></textarea>
      </div>
    </div>     
    
    
    
	<div class="control-group" style="display:inline-block">
     	 <label class="control-label" for="input01">Payment terms</label>
      	<div class="controls">
        	<input type="text" name="payment_terms" class="" value="<?= $r->payment_terms?>" />
      	</div>
    </div> 
        
        
    
    <div class="control-group" style="display:inline-block">
     	 <label class="control-label" for="input01">Valid until</label>
      	<div class="controls">
        	<input type="text" name="valid_until" class="" value="<?= $r->valid_until?>" />
      	</div>
    </div> 
    
 
    <div class="control-group">
      <label class="control-label" for="input01">Notes</label>
      <div class="controls">
        <textarea name="notes" style="width:400px"><?= $r->notes ?></textarea>
      </div>
    </div>     
    
    <div class="control-group">
      <label class="control-label" for="input01">Exclusions</label>
      <div class="controls">
        <textarea name="exclusions" style="width:400px"><?= $r->exclusions ?></textarea>
      </div>
    </div>   
    
      		<div class="control-group">
     	 <label class="control-label" for="input01">Send date</label>
      	<div class="controls">
        	<input type="text" name="send_date" class="datefield" value="<?= $r->send_date?>" />
      	</div>
    	</div> 	

<button class="btn btn-mini" onclick="$('#advanced-fields').slideToggle('fast')"><?= lang('advanced') ?></button>

<div id="advanced-fields" style="display:none">
	<br />
	<div class="white-box">
		<h3><?= lang('quote_requests') ?></h3>
		<?php
			liveTable($this->sales_model->modelData('quotationreq'), 
							array('values' => $this->sales_model->getQuoteRequests(array(0 => 
																	array('key' => 'wf_step', 
																			'val' => 'new'))),
									'show' => 'subject,partner_id,notes,creation_date',
									'actions' => array('0' => array('icon' => 'icon-share',
																	'label' => 'bind to quote',
																	'target' => '/sales/append_to_quote/',
																	'js_class' => 'bindReqToQuote')
														)
								)
						);
		?>
	</div>
	<br />
	
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('currency') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="quotation-currency" name="currency" placeholder="€, $, £..." value="<?= $r->currency ?>"> 	
      </div>
    </div>
		
</div>

<?= form_close() ?>


<?php
	    	
	    endforeach;
	    else:
	    ?>
	    
<?= form_open('sales/save_quote', array('onsubmit'=>'return false', 'class'=>'well form-horizontal', 'id'=>'quote-details')) ?>

	<input type="hidden" name="partner_id" value="<?= $this->session->userdata('current_partner') ?>" />
		
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('title') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge fillhead" id="contact-name" name="title" placeholder="<?= lang('title') ?>"> 	
        <button class="btn btn-primary  btn-mini" id="quote-save-submit"><?= lang('save') ?></button> <span id="quote-save-result"></span>
      </div>
    </div>
    
    	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('type') ?></label>
      <div class="controls">
        <select name="type">
        		<option value="0" >scegli...</option>
        		<option value="spare" >spare</option>
				<option value="project" >project</option>
				<option value="extra" >extra</option>				        		
        </select>
      </div>
    </div>   

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('customer') ?></label>
      <div class="controls">
        <select name="partner_id">
        		<option value="0">scegli...</option>
        	<?php $this->db->order_by('name ASC');
        		$query = $this->db->get_where('partners',  array('status' => 1));
        		foreach($query->result() as $r1): ?>
        		<option value="<?= $r1->id ?>"><?= $r1->name ?></option>
        	<?php endforeach; ?>
        </select>
      </div>
    </div>

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('description') ?></label>
      <div class="controls">
        <textarea name="description" style="width:400px"></textarea>
      </div>
    </div> 

	<span id="quote-save-result"></span>
<?= form_close() ?>
	    
	    <?php
		    endif;
?>


<!-- quotation rows -->

<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th width="30px"></th>
			<th><?= lang('name')?></th>
<!-- 			<th><?= lang('description')?></th> -->
			<th><?= lang('qty')?></th>						
			<th>Unit <?= lang('price_internal')?></th>			
			<th><?= lang('price_external')?></th>	
			<th><?= lang('discount')?></th>					
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($quotation_rows as $q): ?>
		<tr id="quotation_row-<?= $q->id ?>">
			<?= $this->load->view('sales/_quotation_row', $q) ?>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php if($id != 0): $adder = ''; else: $adder = 'none'; endif; ?>
	<p id="adder-el" style="display: <?= $adder ?>" class="pull-right"><button id="quotation-<?= $id ?>" data-toggle="modal" href="#myModal"  class="btn btn-default add-quotation-row"><i class="icon-plus"></i> <?= lang('add_element') ?></button> </p>
<br /><br />

<div id="quote_footer">
	<?php if($id != 0):  ?>
	<?= $this->load->view('sales/quote_footer', array('currency'=>$r->currency)) ?>
	<?php endif; ?>
</div>

<p align="center">
<!--<button class="btn" id="quote-save-submit" onclick="history.back()"><i class="icon-chevron-left"></i> <?= lang('back') ?></button>-->
<?php if($id != 0):  ?>
<button class="btn" id="" onclick="window.location = jQuery.data(document.body, 'base_url')+'sales/'"><i class="icon-chevron-left"></i> <?= lang('back') ?></button>
<!-- <a href="sales/print_quotation_view/" class="btn" id="" onclick="window.location = jQuery.data(document.body, 'base_url')+'sales/print_quotation_view/'"><i class="icon-print"></i> <?= lang('print') ?></button> -->

<?= anchor('sales/print_quotation_view/'.$id, '<i class="icon-repeat icon-white"></i> print', array('target' => '_blank', 'class' => 'btn')) ?>

<button class="btn btn-warning" id="recalculate-quotation"><i class="icon-repeat icon-white"></i> <?= lang('recalculate') ?></button>
<?php if($r->wf_step != 'approved'): ?>
	<button class="btn btn-success" id="quote-approve-submit"><i class="icon-ok-sign icon-white"></i> <?= lang('approve') ?></button>
<?php else: ?>
	<button class="btn btn-primary" id="quote-revoke-submit"><i class="icon-ok-sign icon-white"></i> <?= lang('revoke') ?></button>
<?php endif; ?>

<?php endif; ?>
</p>

<?php if($id != 0):  ?>

  <!-- workflow -->

<?= designWorkflow(1, $r->wf_step, array('table' => 'quotations', 'id' => $this->uri->segment(3))) ?>



  <!--   <ul class="breadcrumb" id="workflow-path">
    <li><b>Workflow</b> <span class="divider">|</span> </li>
    <li>
    <?php if($r->wf_step == 'draft'): ?>
    	<span class="badge badge-info">draft</span> <span class="divider"><i class="icon-chevron-right"></i></span>
    <?php else: ?>
    	draft <span class="divider"><i class="icon-chevron-right"></i></span>
    <?php endif; ?>
    </li>
    <li>
    <?php if($r->wf_step == 'approved'): ?>
    	<span class="badge badge-info">approved</span>
    <?php else: ?>
    	approved
    <?php endif; ?>    
    </li>
    <span class="divider"><i class="icon-chevron-right"></i></span>
    <li>
    <?php if($r->wf_step == 'sent'): ?>
    	<span class="badge badge-info">sent</span>
    <?php else: ?>
    	<a href="#" onclick="fastUpdateWf('sent','quotations',<?= $id ?>)">sent</a>
    <?php endif; ?>    
    </li>
    </ul> -->
<?php endif; ?>   
	    </div>
	    <div class="tab-pane" id="tab2">

		    <?php $this->load->view('sales/attachments'); ?>

	    </div>
	  </div>
	</div>




<script type="text/javascript">

<?php if ($r->wf_step == 'sent'): ?>

	$('#quote-details :input').attr('disabled','disabled');

<?php endif; ?>
        		
</script>