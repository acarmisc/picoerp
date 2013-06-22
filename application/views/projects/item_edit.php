	<div class="tabbable"> <!-- Only required for left/right tabs -->
	  <ul class="nav nav-tabs">
	    <li class="active"><a href="#item_details" data-toggle="tab"><?= lang('details') ?></a></li>
	    <li><a href="#item_attachments" data-toggle="tab"><?= lang('attachments') ?></a></li>
	  </ul>
	  <div class="tab-content" >
	    <div class="tab-pane active" id="item_details">
	    
<?php foreach($item[1] as $r): ?>

<?= form_open('projects/save_item/'.$r->id, array('class'=>'well form-horizontal', 'id'=>'item-details')) ?>
	<input type="hidden" name="project_id" value="<?= $r->project_id ?>" />
	
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('item') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="item-item" name="item" value="<?= $r->item ?>"> 
        from <?= $r->product ?> code
        <input type="text" class="input-small" id="item-item" name="code" value="<?= $r->code ?>"> 
      </div>
      
    </div>

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('description') ?></label>
      <div class="controls">
        <textarea name="description" style="width:400px"><?= $r->description ?></textarea>
      </div>
    </div> 
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('qty') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="item-qty" name="qty" value="<?= $r->qty ?>">
        <input type="text" class="input-small" id="item-unit" name="unit" value="<?= $r->unit ?>"> 	
      </div>
    </div>    
    
    <table width="100%" border="0">
		<tr>
			<td width="33%">
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('order_date') ?></label>
      <div class="controls">
        <input type="text" class="input-small datefield" id="item-order_date" name="order_date" value="<?= $r->order_date ?>">
      </div>
    </div> 			
			</td>
			<td width="33%">
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('delivery_time') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="item-delivery_time" name="delivery_time" value="<?= $r->delivery_time ?>">
      </div>
    </div> 			
			</td>
			<td width="33%">
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('closing_date') ?></label>
      <div class="controls">
        <input type="text" class="input-small datefield" id="item-closing_date" name="closing_date" value="<?= $r->closing_date ?>">
      </div>
    </div> 			
			</td>
		</tr>    
    </table>
    
       
  
    <table width="100%" border="0">
		<tr>
			<td width="33%">
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('price_budget') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="item-price_budget" name="price_budget" value="<?= $r->price_budget ?>">
      </div>
    </div>  			
			</td>
			<td width="33%">
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('price') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="item-price" name="price" value="<?= $r->price ?>">
      </div>
    </div>  			
			</td>
			
			<td width="33%">
	    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('price_sold') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="item-price_sold" name="price_sold" value="<?= $r->price_sold ?>">
      </div>
    </div> 		
			</td>
		</tr>
    </table>
       

     <table width="100%" border="0">
		<tr>
			<td width="33%">
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('currency') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="item-currency" name="currency" value="<?= $r->currency ?>">
      </div>
    </div>  			
			</td>
			<td width="66%">
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('invoice_in') ?></label>
      <div class="controls">
        <input type="file" name="bill" /><br />
        <a href="<?= base_url() ?>/upload/<?= $r->bill ?>"><?= $r->bill ?></a>
      </div>
    </div>     
			
			</td>
		</tr>
    </table>      
    
               

    <button type="submit" class="btn btn-primary"><?= lang('update') ?></button>

<?= form_close() ?>

<?php endforeach; ?>
	    
	    </div>
	    <div class="tab-pane" id="item_attachments">
	    
<?= $this->load->view('attachments/quicklist', array(
														'related_to' => 'project_items',
														'related_to_id' => $r->id,
														'oncomplete' => 'projects/show_project/'.$r->project_id)); ?>
	    

	    </div>    
	    
	  </div>
	</div>


<!-- workflow -->

<?= designWorkflow(6, $r->wf_step, array('table' => 'project_items', 'id' => $r->id)) ?>

	    	