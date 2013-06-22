<?php foreach($product as $r){ ?>
<?= form_open('sales/save_product/'.$r->id, array('onsubmit'=>'', 'class'=>'well form-horizontal', 'id'=>'product-details')) ?>

	<input type="hidden" name="update_date" value="<?= $r->update_date ?>" />	

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('name') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="product-name" name="name" value="<?= $r->name ?>" /> 	
      </div>
    </div>


	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('description') ?></label>
      <div class="controls">
        <textarea class="input-xlarge" id="product-description" name="description"><?= $r->description ?></textarea>
      </div>
    </div>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('brand') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="product-brand" name="brand" value="<?= $r->brand ?>" /> 	
      </div>
    </div>

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('unit') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="product-unit" name="unit" value="<?= $r->unit ?>" /> 	
      </div>
    </div>

    <input type="submit" class="btn btn-primary" value="<?= lang('update') ?>" />

<?= form_close() ?>
<?php } ?>