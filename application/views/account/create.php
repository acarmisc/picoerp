<script>
function adaptForm(){

	val = $('#direction-field').val();
	if (val == 2 || val == 3){
		$('#number').attr('disabled','disabled');
		$('#customer_order-slot').fadeIn();
		$('#sal_id').attr('disabled',false);	
		$('#purchase_order_id').attr('disabled','disabled');			
	} else{
		$('#number').attr('disabled',false);
		$('#customer_order-slot').fadeOut();	
		$('#sal_id').attr('disabled','disabled');
		$('#purchase_order_id').attr('disabled',false);		
	}
	
}

</script>

<?= form_open('account/invoice_save/', array('onsubmit'=>'', 'class'=>'well form-horizontal', 'id'=>'invoice-details')) ?>

	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">number</label>
      <div class="controls">
        <input class="input-large" id="number" name="number" value="" type="text">
      </div>
    </div>

	<div class="control-group" width: 440px">
      <label class="control-label">direction</label>
      <div class="controls">
      	<select name="direction" id="direction-field" class="input-large" onchange="adaptForm()">
      		<option value="0" selected="selected">choose...</option>
      		<option value="2">invoice out</option>
      		<option value="1">invoice in</option>
      		<option value="3">credit note out</option>
      		<option value="4">credit note in</option>
      	</select>
      	
      </div>
    </div>

    <div class="control-group" width: 440px">
      <label class="control-label">Project</label>
      <div class="controls">
      	<select name="project_id" class="input-large">
      		<option value="">...</option>
      		<?php foreach($this->projects_model->getProjects() as $p){ ?>
      			<option value="<?= $p->id ?>"><?= $p->ordine_cliente ?> - <?= $p->title?> <?= $p->name ?></option>
      		<?php } ?>
      	</select>
      </div>
    </div>
    
    
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
      			<option value="<?= $a->id ?>"><?= $a->userfile ?> - <?= $a->ordine_cliente ?></option>
      		<?php } ?>
      	</select>
      	<span id="project_name"></span>
      </div>
    </div>
    
    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">partner</label>
      <div class="controls">
      	<select name="partner_id" class="input-large">
      		<option value="">...</option>
      		<?php foreach($this->crm_model->getPartners() as $p){ ?>
      			<option value="<?= $p->id ?>"><?= $p->name ?></option>
      		<?php } ?>
      	</select>
      </div>
    </div>

    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">description</label>
      <div class="controls">
        <textarea id="description" name="description" class="input-xlarge"></textarea>
      </div>
    </div>

    
	<div class="control-group" style="display:inline-table; width: 440px; display:none" id="customer_order-slot">
      <label class="control-label">customer order</label>
      <div class="controls">
        <input class="input-large" id="customer_order" name="customer_order" value="" type="text">
      </div>
    </div>      
            
  


    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">Purchase order</label>
      <div class="controls">
      	<select name="purchase_order_id" id="purchase_order_id" class="input-large">
      		
      		<option value="">...</option>
      		<?php $purchases = $this->purchases_model->getPurchases(); 
      			foreach($purchases as $purc): ?>
      			<option value="<?= $purc->id ?>"><?= $purc->number ?> <?= $purc->subject ?> </option>
      		<?php endforeach; ?>
      	</select>
      	
      </div>
    </div>

    
    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">amount untaxed</label>
      <div class="controls">
        	<div class="input-append">
        	<input class="input-large money_field" id="amount_untaxed" name="amount_untaxed" value="" type="text" placeholder="0.00">
        	<span class="add-on">&euro;</span>
        	</div>
      </div>
    </div>    

	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">taxes</label>
      <div class="controls">
        	<div class="input-append">
        	<input class="input-small percent_field" id="taxes" name="taxes" value="" type="text">
        	<span class="add-on">%</span>
        	</div>
      </div>
    </div>    


	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">taxes notes</label>
      <div class="controls">
        	<input class="input-xlarge" id="taxes" name="taxes_notes" value="" type="text" />
       </div>
    </div>
    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">amount</label>
      <div class="controls">
        	<div class="input-append">
        	<input class="input-large money_field" id="amount" name="amount" value="" type="text" placeholder="0.00">
        	<span class="add-on">&euro;</span>
        	</div>
      </div>
    </div>



  <div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">amount in char</label>
      <div class="controls">
          <div class="input-append">
          <input class="input-large" id="literal_price" name="literal_price" value="" type="text" placeholder="">
          <span class="add-on">&euro;</span>
          </div>
      </div>
    </div>   
    
   
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">transfer</label>
      <div class="controls">
        	<div class="input-append">
        	<input class="input-large money_field" id="transfer" name="transfer" value="" type="text" placeholder="0.00">
        	<span class="add-on">&euro;</span>
        	</div>
      </div>
    </div>
    


	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">period</label>
      <div class="controls">
        <input class="input-large" id="period" name="period" value="" type="text">
      </div>
    </div>    
    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">progress percentage</label>
      <div class="controls">
        	<div class="input-append">
        	<input class="input-mini percent_field" id="progress_step" name="progress_step" value="" type="text">
        	<span class="add-on">%</span>
        	</div>
        	 TOT
        	<div class="input-append">
        	<input class="input-mini percent_field" id="progress_percentage" name="progress_percentage" value="" type="text">
        	<span class="add-on">%</span>
        	</div>
      </div>
    </div>    
    
    <br />
    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">Payment method</label>
      <div class="controls">
      	<select name="payment_method_id" class="input-large">
      		<option value="" selected="selected">select...</option>
      		<?php $query = $this->db->get_where('payment_methods'); 
      		foreach($query->result() as $r){ ?>
      		<option value="<?= $r->id ?>"><?= $r->name ?></option>
      		<?php } ?>
      	</select>
      	
      </div>
    </div>
    <br />
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">date due</label>
      <div class="controls ">
        
        <div id="date_due" name="date_due"  class="input-append date" id="dp3" data-date="<?= date('d-m-Y',time()) ?>" data-date-format="dd-mm-yyyy">
  		<input class="input-small datefield" size="16" type="text" value="<?= date('d-m-Y',time()) ?>" name="date_due">
  <span class="add-on"><i class="icon-th"></i></span>
</div>
      </div>
    </div>
    
	<div class="control-group" style="display:inline-table; width: 440px">
      <label class="control-label">invoice date</label>
      <div class="controls ">
        
        <div id="invoice_date" name="invoice_date" class="input-append date" id="dp3" data-date="<?= date('d-m-Y',time()) ?>" data-date-format="dd-mm-yyyy">
  		<input class="input-small datefield" size="16" type="text" value="<?= date('d-m-Y',time()) ?>" name="invoice_date" />
  <span class="add-on"><i class="icon-th"></i></span>
      </div>
    </div>
	<br />
	<div class="control-group" style="">
      <label class="control-label">Notes printable</label>
      <div class="controls">
	      <textarea style="width:400px" name="notes_printable" rows="5"></textarea>
      </div>
    </div>   			
			
	<input type="submit" class="btn btn-primary" value="<?= lang('create') ?>" />
			
<?= form_close() ?>


<script>
	function bindToProject(){
		id = $('#sal_id').val();
		
		$.ajax({
            type:'GET',
            url: jQuery.data(document.body, 'base_url')+'account/bind_to_project/'+id,
            success:function(data){
            	$('#customer_order').val(data);
            }
        });
        
	}
</script>