<?php if(isset($flash_messages)){ echo showFlashes($flash_messages); } ?>

<?= form_open('sales/save_product/', array('onsubmit'=>'return false', 'class'=>'well form-horizontal', 'id'=>'product-details')) ?>

	<input type="hidden" name="creation_date" value="<?= time() ?>" />
	<input type="hidden" name="update_date" value="<?= time() ?>" />	
	<input type="hidden" name="creation_uid" value="<?= $this->session->userdata('u_logged_in') ?>" />		

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('name') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="product-name" name="name" /> 	
      </div>
    </div>


	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('description') ?></label>
      <div class="controls">
        <textarea class="input-xlarge" id="product-description" name="description"></textarea>
      </div>
    </div>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('brand') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="product-brand" name="brand" /> 	
      </div>
    </div>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('unit') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="product-unit" name="unit" /> 	
      </div>
    </div>

    <input type="submit" class="btn btn-primary" value="<?= lang('save') ?>" />

<?= form_close() ?>