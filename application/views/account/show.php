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
	    		
	    		<li><?= anchor('account/print_data/'.$this->uri->segment(3), 
	    		'<i class="icon-picture"></i> '.lang('print').' data',
	    		array('target'=>'_blank', 'class'=>'')) ?></li>
	    	</ul>
	    </div>
	    </div>
	    	<?php } ?>
 
<?= form_open('account/invoice_update/'.$this->uri->segment(3), array('onsubmit'=>'', 'class'=>'well form-horizontal', 'id'=>'invoice-details')) ?>
			
			
<?php
	$query = $this->db->get_where('invoices', array('id' => $this->uri->segment(3)));
	foreach ($query->result() as $r){
	
	?>			

	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">Project</label>
      <div class="controls">
      	<?php 
      		$query_prj = $this->db->get_where('projects', array('id' => $r->project_id));
      		foreach($query_prj->result() as $q_prj){ ?>
	<input class="input-large" id="number" name="number" value="<?= $q_prj->name ?>" type="text"> 
	<a href="/projects/show_project/<?= $q_prj->id?>">View ></a>
      	<?php 	}
      	?>
        
      </div>
    </div>

	
	
	
	
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">number</label>
      <div class="controls">
        <input class="input-large" id="number" name="number" value="<?= $r->number ?>" type="text">
      </div>
    </div>



	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">direction</label>
      <div class="controls">
      	<?php if($r->wf_step == 'sent'or $r->wf_step == 'approved'){ $d = ' disabled="disabled" '; }else{ $d = ''; } ?>
      	<select <?= $d ?> name="direction" id="direction-field" class="input-large" onchange="adaptForm()">
      		
      		<option<?php if($r->direction == 0){ echo ' selected="selected" '; } ?> value="0">choose...</option>
      		<option<?php if($r->direction == 2){ echo ' selected="selected" '; } ?> value="2">invoice out</option>
      		<option<?php if($r->direction == 1){ echo ' selected="selected" '; } ?> value="1">invoice in</option>
      		<option<?php if($r->direction == 3){ echo ' selected="selected" '; } ?> value="3">credit note out</option>
      		<option<?php if($r->direction == 4){ echo ' selected="selected" '; } ?> value="4">credit note in</option>

      	</select>
      	
      </div>
    </div>

    <?php if(isset($r->sal_id)){ ?>
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">SAL/DDT</label>
      <div class="controls">
      	<select name="sal_id" id="sal_id" class="input-xlarge" onchange="bindToProject()">
      		<option value="0">...</option>
      		      			
      		      			
      		      			<?php
      		      				$this->db->order_by('userfile ASC');
      		      				$this->db->where('scope_id',6);
      		      				$this->db->or_where('scope_id',5);      		      				
      		      				$query5 = $this->db->get('attachments');
      		      				foreach($query5->result() as $r5){ 
      		      					if($r5->id == $r->sal_id){ $s = ' selected="selected" '; }
      		      					else{ $s = ''; } ?>
	      		      			<option <?= $s ?> value="<?= $r5->id ?>"><?= $r5->userfile ?></option>	
      		      			<?php	}	?>
      		      			
      		      	</select>
      	<span id="project_name"></span>
      </div>
    </div>
    <?php } ?>
    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">partner</label>
      <div class="controls">
      	<?php if($r->wf_step == 'sent'or $r->wf_step == 'approved'){ $d = ' disabled="disabled" '; }else{ $d = ''; } ?>
      	<select <?= $d ?> name="partner_id" class="input-large">
      		<option value="">...</option>
      		      			<?php
      		      				$query2 = $this->db->get('partners');
      		      				foreach($query2->result() as $r2){ 
      		      					if($r2->id == $r->partner_id){ $s = ' selected="selected" '; }
      		      					else{ $s = ''; } ?>
	      		      			<option <?= $s ?> value="<?= $r2->id ?>"><?= $r2->name ?></option>	
      		      			<?php	}	?>
      		      	</select>
      </div>
    </div>

    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">description</label>
      <div class="controls">
        <textarea id="description" name="description" class="input-xlarge"><?= $r->description ?></textarea>
      </div>
    </div>

    
	<div class="control-group" style="display:inline-table; width: 440px; display:none" id="customer_order-slot">
      <label class="control-label">customer order</label>
      <div class="controls">
        <input class="input-large" id="customer_order" name="customer_order" value="<?= $r->customer_order ?>" type="text">
      </div>
    </div>      
            
  


    <?php if ($r->direction != 2): ?>
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">Purchase order</label>
      <div class="controls">
      	<?php if($r->wf_step == 'sent'or $r->wf_step == 'approved'){ $d = ' disabled="disabled" '; }else{ $d = ''; } ?>
      	    
      	<select <?= $d ?> name="purchase_order_id" id="purchase_order_id" class="input-large">
      		
      		<option value="">...</option>
      		      			<?php
      		      				$query3 = $this->db->get('purchases');
      		      				foreach($query3->result() as $r3){ 
      		      					if($r3->id == $r->purchase_order_id){ $s = ' selected="selected" '; }
      		      					else{ $s = ''; } ?>
	      		      			<option <?= $s ?> value="<?= $r3->id ?>"><?= $r3->subject ?></option>	
      		      			<?php	}	?>
      		      	</select>
      	
      </div>
    </div>
    
    <?php endif;?>

    <!-- 
<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">SAL/DDT</label>
      <div class="controls">
      	<select name="sal_id" id="sal_id" class="input-xlarge" onchange="bindToProject()">
      		<option value="0">...</option>
      		<?php
      			$this->db->select('attachments.id, attachments.userfile, projects.ordine_cliente');
      			$this->db->where('scope_id',5);
      			$this->db->or_where('scope_id',6);
      			$this->db->join('projects', 'projects.id = attachments.related_to_id');
      			$query = $this->db->get('attachments'); 
      			foreach($query->result() as $a){ ?>
      			<option value="<?= $a->id ?>"><?= $a->userfile ?> <?= $a->ordine_cliente ?></option>
      		<?php } ?>
      	</select>
      	<span id="project_name"></span>
      </div>
    </div>
    -->

    
    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">amount untaxed</label>
      <div class="controls">
        	<div class="input-append">
        	<input class="input-large money_field" id="amount_untaxed" name="amount_untaxed" value="<?= $r->amount_untaxed ?>" type="text" placeholder="0.00">
        	<span class="add-on">&euro;</span>
        	</div>
      </div>
    </div>    

	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">taxes</label>
      <div class="controls">
        	<div class="input-append">
        	<input class="input-small percent_field" id="taxes" name="taxes" value="<?= $r->taxes ?>" type="text">
        	<span class="add-on">%</span>
        	</div>
      </div>
    </div>    


	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">taxes notes</label>
      <div class="controls">
        	<input class="input-xlarge" id="taxes" name="taxes_notes" value="<?= $r->taxes_notes ?>" type="text" />
       </div>
    </div>
    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">amount</label>
      <div class="controls">
        	<div class="input-append">
        	<input class="input-large money_field" id="amount" name="amount" value="<?= $r->amount ?>" type="text" placeholder="0.00">
        	<span class="add-on">&euro;</span>
        	</div>
      </div>
    </div>

  <div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">Total in char</label>
      <div class="controls">
          <div class="input-append">
          <input class="input-large" id="literal_price" name="literal_price" value="<?= $r->literal_price ?>" type="text" placeholder="">
          <span class="add-on">&euro;</span>
          </div>
      </div>
    </div>    
    
   
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">transfer</label>
      <div class="controls">
        	<div class="input-append">
        	<input class="input-large money_field" id="transfer" name="transfer" value="<?= $r->transfer ?>" type="text" placeholder="0.00">
        	<span class="add-on">&euro;</span>
        	</div>
      </div>
    </div>
    
  <div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">transport</label>
      <div class="controls">
          <div class="input-append">
          <input class="input-large money_field" id="transport" name="transport_notes" value="<?= $r->transport_notes ?>" type="text" placeholder="0.00">
          <span class="add-on">&euro;</span>
          </div>
      </div>
    </div>    

	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">period</label>
      <div class="controls">
        <input class="input-large" id="period" name="period" value="<?= $r->period ?>" type="text">
      </div>
    </div>    
    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">progress percentage</label>
      <div class="controls">
        	<div class="input-append">
        	<input class="input-mini percent_field" id="progress_step" name="progress_step" value="<?= $r->progress_step ?>" type="text">
        	<span class="add-on">%</span>
        	</div>
        	 TOT
        	<div class="input-append">
        	<input class="input-mini percent_field" id="progress_percentage" name="progress_percentage" value="<?= $r->progress_percentage ?>" type="text">
        	<span class="add-on">%</span>
          
        	</div>
          <div>
            
            <input type="radio" name="show_progress" id="optionsRadios1" value="1" <?php echo $r->show_progress == '1' ? 'checked': 'none' ?>>
            Show in invoice
            
            
            <input type="radio" name="show_progress" id="optionsRadios2" value="0" <?php echo $r->show_progress == '0' ? 'checked': '' ?>>
            Hide
            
            <!--<input type="checkbox" name="show_progress" value="1" /><span>Show in invoice</span></div>-->
      </div>
    </div>    


    <br />
    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">Payment method</label>
      <div class="controls">
      	<select name="payment_method_id" class="input-large">
      		<option value="" selected="selected">select...</option>
      		
      			<?php
      				$query4 = $this->db->get('payment_methods');
      				foreach($query4->result() as $r4){ 
      					if($r4->id == $r->payment_method_id){ $s = ' selected="selected" '; }
      					else{ $s = ''; } ?>
	      			<option <?= $s ?> value="<?= $r4->id ?>"><?= $r4->name ?></option>	
      			<?php	}	?>
      		
      		      		      		      	</select>
      	
      </div>
    </div>
    <br />
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">date due</label>
      <div class="controls ">
        <input class="input-small datefield" datefield="" input-append="" id="date_due" name="date_due" value="<?= $r->date_due ?>" type="text"><span class="add-on"><i class="icon-th"></i></span>
      </div>
    </div>
    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">invoice date</label>
      <div class="controls ">
        <input class="input-small datefield" datefield="" input-append"="" id="invoice_date" name="invoice_date" value="<?= $r->invoice_date ?>" type="text"><span class="add-on"><i class="icon-th"></i></span>
      </div>
    </div>


	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">notes</label>
      <div class="controls">
        <textarea id="notes" name="notes" class="input-xlarge"><?= $r->notes ?></textarea>
      </div>
    </div>
				
		<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">notes printable</label>
      <div class="controls">
        <textarea id="notes" name="notes_printable" class="input-xlarge"><?= $r->notes_printable ?></textarea>
      </div>
    </div>  

    

      			<br />
			
			<input type="submit" value="<?= lang('save') ?>" class="btn btn-primary" />
			
			
	<?php } ?>			
			
</form>


			
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
	

<script>

<?php if ($invoice[0]->wf_step == 'payment'): ?>

	$('#invoice-details :input').attr('disabled','disabled');
	//$('#invoice-details textarea').attr('disabled','disabled');

<?php endif; ?>
	
</script>