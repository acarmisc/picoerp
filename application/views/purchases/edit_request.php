<?php if($this->uri->segment(2) != 'show_purchases'){ ?>

<div class="alert alert-info">Please complete the informations required to create a purchase request for your current project.</div>

<?php } ?>


<?php
	$total = 0;
	$this->db->select('purchase_request_rows.id, project_items.item, project_items.price_budget, purchase_request_rows.qty, purchase_request_rows.description');
	$this->db->join('project_items', 'project_items.id = purchase_request_rows.project_item_id', 'left');	
	$query = $this->db->get_where('purchase_request_rows', array('purchase_request_id' => $this->uri->segment(3)));
	$lines = $query->result();
	
	foreach($lines as $l){ 
		$total += $l->price_budget;
	}
?>
<div class="pull-right">
	    <div class="btn-group">
		    <button class="btn btn-inverse"><i class="icon-share-alt icon-white"></i> Share</button>
		    <button class="btn dropdown-toggle btn-inverse" data-toggle="dropdown">
		    	<span class="caret"></span>
		    </button>
		    <ul class="dropdown-menu">
		    	<li><?= anchor('purchases/print_purchases_request/'.$this->uri->segment(3), 
	    		'<i class="icon-print"></i> '.lang('print'),
	    		array('target'=>'_blank', 'class'=>'')) ?></li>
	    		<li><?= anchor('purchases/print_preview_purchases_request/'.$this->uri->segment(3), 
	    		'<i class="icon-print"></i> '.lang('print').' preview',
	    		array('target'=>'_blank', 'class'=>'')) ?></li>
	    	</ul>
	    </div>
	    </div>
<?= form_open('purchases/update_purchase_request/'.$data->id, array('onsubmit'=>'', 'class'=>'well form-horizontal', 'id'=>'purchase-request-details-update')) ?>

	<input type="hidden" name="project_id" value="<?= $data->project_id ?>" />
	<input type="hidden" name="update_date" value="<?= time() ?>" />
			
	<div class="righter">
		Total budget: 
		&euro; <?= $total ?>
	</div>
			
<div class="control-group">
      <label class="control-label" for="input01"><?= lang('subject') ?></label>
      <div class="controls">
        <input type="text" class="input-xlarge" id="purchase-currency" name="subject" value="<?= $data->subject ?>"> 	
      </div>
    </div>      
            

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('deviation') ?></label>
      <div class="controls">
        <textarea name="deviation" style="width:400px"><?= $data->deviation ?></textarea>
      </div>
    </div> 

    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('description') ?></label>
      <div class="controls">
        <textarea name="description" style="width:400px"><?= $data->description ?></textarea>
      </div>
    </div> 
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('supplier') ?></label>
      <div class="controls">
	      <select name="supplier_id" disabled="disabled">
	      	<?php
	      		$query = $this->db->get_where('partners', array('supplier' => 1));
	      		foreach($query->result() as $row){
		      		if($data->supplier_id == $row->id){ $s = ' selected="selected" '; }else{ $s = ''; }
	      		
	      	?>
		    	<option <?= $s ?> value="<?= $row->id ?>"><?= $row->name ?></option>	  		
	      	<?php
	      		}
	      	?>
	      </select>
      </div>
    </div>        
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('price_extimated') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="purchase-price_extimated" name="price_extimated" value="<?= $data->price_extimated ?>"> 	
      </div>
    </div>  
    
	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('quotation_ref') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="purchase-quotation_ref" name="quotation_ref" value="<?= $data->quotation_ref ?>"> 	
      </div>
    </div>      

	<div class="control-group">
      <label class="control-label" for="input01"><?= lang('delivery_request') ?></label>
      <div class="controls">
        <input type="text" class="input-small" id="purchase-delivery_request" name="delivery_request" value="<?= $data->delivery_request ?>"> 	
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('shipping_address') ?></label>
      <div class="controls">
        <textarea name="shipping_address" style="width:400px"><?= $data->shipping_address ?></textarea>
      </div>
    </div>     
			
			
			
			
    <div class="control-group">
      <label class="control-label" for="input01"><?= lang('description') ?></label>
      <div class="controls">
        <textarea name="description" style="width:400px"><?= $data->description ?></textarea>
      </div>
    </div> 

    <input type="submit" class="btn btn-primary" value="<?= lang('update') ?>" />

		

<?= form_close() ?>

<?= designWorkflow(7, $data->wf_step, array('table' => 'purchase_request', 'id' => $data->id)) ?>

<h4>Items</h4>

<div id="my_temp_target" style="padding: 20px;">
	
	
</div>

<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th width="30px"></th>
			<th><?= lang('name')?></th>		
			<th><?= lang('description')?></th>						
			<th><?= lang('qty')?></th>	
			<th></th>
		</tr>
	</thead>
	<tbody id="agile-table">
<?php
	
	foreach($lines as $r){
	?>
		<tr>
			<td></td>
			<td><?= $r->item ?></td>
			<td><?= $r->description ?></td>
			<td><?= $r->qty ?></td>
			<td>
				<a rel="tooltip" title="show details" data-toggle="modal" href="#myModal" class="purchase_request_item_show" name="<?= $r->id ?>"><i class="icon-pencil"></i></a>
				<?= anchor('/purchases/delete_purchase_request_row/'.$r->id.'/'.$data->id,'<i class="icon-trash"></i>') ?>
			</td>															
		</tr>
	<?php
		
	}
?>	
	</tbody>	
</table>


<p id="adder-el" style="" class="pull-right"><button id="purchase-<?= $this->session->userdata('current_project') ?>" class="btn btn-default add-purchase-request-row"><i class="icon-plus"></i> <?= lang('add_element') ?></button> </p>

<?php if($data->wf_step == 'approved'){ ?>
	<p align="center">
		
		<?= anchor('/purchases/convert_to_order/'.$data->id,'<i class="icon-cog"></i> '.lang('convert_to_purchase_order')) ?>
		
	</p>
<?php } ?>