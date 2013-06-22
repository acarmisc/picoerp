<div class="alert alert-info">Please complete the informations required to create a purchase request (RDA) for your current project.</div>

<?= form_open('purchase/save_purchase_request/', array('onsubmit'=>'return false', 'class'=>'well form-horizontal', 'id'=>'purchase-request-details')) ?>

	<input type="hidden" name="project_id" value="<?= $this->session->userdata['current_project'] ?>" />

	<input type="hidden" name="update_date" value="<?= time() ?>" />
	
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('number') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="purchase-number" name="number"> 	
      </div>
    </div>   

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('subject') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="purchase-currency" name="subject"> 	
      </div>
    </div>      
            

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('deviation') ?></label>
      <div class="controls">
        <textarea name="deviation" style="width:400px"></textarea>
      </div>
    </div> 

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('description') ?></label>
      <div class="controls">
        <textarea name="description" style="width:400px"></textarea>
      </div>
    </div> 
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('supplier') ?></label>
      <div class="controls">
	      <select name="supplier_id">
	      	<?php
	      		$query = $this->db->get_where('partners', array('supplier' => 1));
	      		foreach($query->result() as $row){
	      	?>
		    	<option value="<?= $row->id ?>"><?= $row->name ?></option>	  		
	      	<?php
	      		}
	      	?>
	      </select>
      </div>
    </div>        
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('price_extimated') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="purchase-price_extimated" name="price_extimated"> 	
      </div>
    </div>  
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('quotation_ref') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="purchase-quotation_ref" name="quotation_ref"> 	
      </div>
    </div>      

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('delivery_request') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="purchase-delivery_request" name="delivery_request"> 	
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('shipping_address') ?></label>
      <div class="controls">
        <textarea name="shipping_address" style="width:400px"></textarea>
      </div>
    </div>     
        
    
    <input type="hidden" name="wf_flow" value="3" />
    <input type="hidden" name="wf_step" value="draft" />   
    <input type="hidden" name="creation_uid" value="1" />        
    <input type="hidden" name="creation_date" value="<?= time() ?>" />            

    <button type="submit" class="btn btn-primary"><?= lang('create') ?></button>

		

<?= form_close() ?>

<?= designWorkflow(3, 'draft') ?>

<h4>Items</h4>

<div id="my_temp_target" style="padding: 20px;"></div>

<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th width="30px"></th>
			<th><?= lang('name')?></th>
			<th><?= lang('description')?></th>
			<th><?= lang('qty')?></th>	
			<th><?= lang('estimated_cost')?></th>		
			<th><?= lang('delivery')?></th>											
			<th></th>
		</tr>
	</thead>
</table>

<p id="adder-el" style="" class="pull-right"><button id="purchase-<?= $this->session->userdata('current_project') ?>" class="btn btn-default add-purchase-row"><i class="icon-plus"></i> <?= lang('add_element') ?></button> </p>