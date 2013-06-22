<?php
	$query = $this->db->get_where('purchase_request', array('id' => $id));
	
?>
<?php foreach($query->result() as $data){ ?>

<div class="alert alert-info">Please complete the informations required to create a purchase order for your current project.</div>

<?php } ?>

<?= form_open('purchases/convert_purchase/'.$data->id, array('onsubmit'=>'', 'class'=>'well form-horizontal', 'id'=>'purchase-details-update')) ?>

	<input type="hidden" name="project_id" value="<?= $data->project_id ?>" />
	<input type="hidden" name="creation_date" value="<?= time() ?>" />
	<input type="hidden" name="wf_flow" value="3" />	
	<input type="hidden" name="wf_step" value="draft" />		
			
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('supplier') ?></label>
      <div class="controls">
      		<select name="partner_id">
        	<?php $query = $this->db->get_where('partners');
        		foreach($query->result() as $r1): ?>
        		<option value="<?= $r1->id ?>"> <?= $r1->name ?></b>
        	<?php endforeach; ?>
        	</select>
      </div>
    </div>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('subject') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="purchase-currency" name="subject" value="<?= $data->subject ?>"> 	
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
        <textarea name="description" style="width:400px"><?= $data->description ?></textarea>
      </div>
    </div> 

    <button type="submit" class="btn btn-primary"><?= lang('save') ?></button>

		

<?= form_close() ?>
