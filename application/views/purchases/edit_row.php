<?php foreach($row as $data){ ?>
<?= form_open('purchases/save_row/'.$data->id, array('onsubmit'=>'', 'class'=>'well form-horizontal', 'id'=>'purchase-row-save')) ?>

	<input type="hidden" name="update_date" value="<?= time() ?>" />

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('qty') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="qty" name="qty" value="<?= $data->qty ?>"> 	
      </div>
    </div>      
    

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('description') ?></label>
      <div class="controls">
        <textarea name="description" style="width:400px"><?= $data->description ?></textarea>
      </div>
    </div> 


  <div class="control-group">
      <label class="control-label" for="input01"><?= lang('price') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="price" name="price" value="<?= $data->price ?>">   
      </div>
    </div>  


  <div class="control-group">
      <label class="control-label" for="input01">Unity of Measure</label>
      <div class="controls">
        <input type="text" class="input-small" id="uom" name="uom" value="<?= $data->uom ?>">   
      </div>
    </div>      


  <div class="control-group">
      <label class="control-label" for="input01"><?= lang('discount') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="discount" name="discount" value="<?= $data->discount ?>">   
      </div>
    </div>  


    <div class="control-group">
      <label class="control-label" for="input01">Total</label>
      <div class="controls">
        <input type="text" class="input-small" id="total" name="total" value="<?= $data->total ?>">   
      </div>
    </div>  

    <button type="submit" class="btn btn-primary"><?= lang('update') ?></button>

		

<?= form_close() ?>

<?php } ?>