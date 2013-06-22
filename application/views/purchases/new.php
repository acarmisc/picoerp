<div class="alert alert-info">Please complete the informations required to create a purchase order for your current project.</div>

<?= form_open('purchase/save_purchase/', array('onsubmit'=>'return false', 'class'=>'well form-horizontal', 'id'=>'purchase-details')) ?>

	<input type="hidden" name="project_id" value="<?= $this->session->userdata['current_project'] ?>" />

	<input type="hidden" name="update_date" value="<?= time() ?>" />
			
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('supplier') ?></label>
      <div class="controls">
         <select name="partner_id">
        		<option value="0">scegli...</option>
        	<?php $query = $this->db->get_where('partners', array('supplier'=>1));
        		foreach($query->result() as $r1): ?>
        		<option value="<?= $r1->id ?>"><?= $r1->name ?></option>
        	<?php endforeach; ?>
        </select>
      </div>
    </div>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('subject') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="purchase-currency" name="subject"> 	
      </div>
    </div>    
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('arrival_date') ?></label>
      <div class="controls">
        <input class="input-small datefield" datefield="" id="arrival_date" name="arrival_date" type="text">
      </div>
    </div>       
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('delivery_address') ?></label>
      <div class="controls">
        <textarea name="delivery_address" style="width:400px"></textarea>
      </div>
    </div>        

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('description') ?></label>
      <div class="controls">
        <textarea name="description" style="width:400px"></textarea>
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