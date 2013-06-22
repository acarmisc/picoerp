	<div class="tabbable"> <!-- Only required for left/right tabs -->
	  <ul class="nav nav-tabs">
	    <li class="active"><a href="#item_details" data-toggle="tab"><?= lang('details') ?></a></li>
	    <li><a href="#new_product" data-toggle="tab"><?= lang('new_product') ?></a></li>
	  </ul>
	  <div class="tab-content" >
	    <div class="tab-pane active" id="item_details">
	    
<?= form_open('projects/create_item/', array('class'=>'well form-horizontal', 'id'=>'item-details')) ?>
	<input type="hidden" name="project_id" value="<?= $this->session->userdata('current_project') ?>" />
	<input type="hidden" name="creation_date" value="<?= time() ?>" />	
	
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('item') ?></label>
      <div class="controls">
        <input type="text" class="input-large" id="item-item" name="item" value=""> 
        from 
        <select name="product_id">
	        <option value="0">none</option>
        	<?php
        		$this->db->order_by('name ASC');
        		$query = $this->db->get_where('products');
        		foreach($query->result() as $r1){ ?>
	        		<option value="<?= $r1->id ?>"><?= $r1->name ?> (<?= $r1->brand ?>)</option>
        		<?php } ?>
        </select>   
        
        <a href="#" class="falseButton" title="create new product" rel="tooltip" id="reload-product-select"><i class="icon-repeat"></i></a>
             
      </div>
      
    </div>
    
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('description') ?></label>
      <div class="controls">
        <textarea name="description" style="width:500px; height: 40px;"></textarea>
      </div>
    </div> 
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('qty') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="item-qty" name="qty" value="">
        <input type="text" class="input-small" id="item-unit" name="unit" value=""> 	

      code 
      <input type="text" class="input-small" id="item-item" name="code" value=""> 
            </div>
    </div>    
    
    <table width="100%" border="0">
		<tr>
			<td width="33%">
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('order_date') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="item-order_date" name="order_date" value="">
      </div>
    </div> 			
			</td>
			<td width="33%">
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('delivery_time') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="item-delivery_time" name="delivery_time" value="">
      </div>
    </div> 			
			</td>
			<td width="33%">
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('closing_date') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="item-closing_date" name="closing_date" value="">
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
        <input type="text" class="input-small" id="item-price_budget" name="price_budget" value="">
      </div>
    </div>  			
			</td>
			<td width="33%">
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('price') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="item-price" name="currency" value="">
      </div>
    </div>  			
			</td>
			
			<td width="33%">
	    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('price_sold') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="item-price_sold" name="price_sold" value="">
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
        <input type="text" class="input-small" id="item-currency" name="currency" value="€">
      </div>
    </div>  			
			</td>
			<td width="66%">
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('invoice_in') ?></label>
      <div class="controls">
        <input type="file" name="bill" /><br />
      </div>
    </div>     
			
			</td>
		</tr>
    </table>      
    
    <div class="control-group">
      <label class="control-label" for="input01">Extra?</label>
      <div class="controls">
        <select name="label">
        	<option value="extra">Yes</option>
        	<option value="post" selected="selected">No</option>        	
        </select>
        	<p class="pull-right">
	            <button type="submit" class="btn btn-primary"><?= lang('save') ?></button>
        	</p>
      </div>
      
    </div>           


<?= form_close() ?>
	    
	    </div>
	    <div class="tab-pane" id="new_product">
	        <div class="form-in-form">
    	<?= $this->load->view('sales/agile_new_product') ?>
    </div>

	    </div>
	  </div>

	    	